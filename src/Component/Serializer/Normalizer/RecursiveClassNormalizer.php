<?php
namespace Component\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class RecursiveClassNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        $data = ['__jsonclass__' => get_class($object)];

        $reflectionClass = new \ReflectionClass($object);

        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            if (strtolower(substr($reflectionMethod->getName(), 0, 3)) !== 'get') {
                continue;
            }

            if ($reflectionMethod->getNumberOfRequiredParameters() > 0) {
                continue;
            }

            $attributeName = lcfirst(substr($reflectionMethod->getName(), 3));

            if (!$reflectionClass->hasProperty($attributeName)) {
                continue;
            }

            $attributeValue = $reflectionMethod->invoke($object);

            if (null !== $attributeValue && !is_scalar($attributeValue)) {
                if (!$this->serializer instanceof NormalizerInterface) {
                    throw new LogicException(
                        sprintf(
                            'Cannot normalize attribute "%s" because injected serializer is not a normalizer',
                            $attributeName
                        )
                    );
                }

                $attributeValue = $this->serializer->normalize($attributeValue, $format, $context);
            }

            $data[$attributeName] = $attributeValue;
        }

        return $data;
    }


    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = $this->convertArrayToObject($data);

        return $object;
    }


    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && 'json' === $format;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return isset($data['__jsonclass__']) && 'json' === $format;
    }

    private function convertArrayToObject($data)
    {
        if (!is_array($data)) {
            return $data;
        }

        if (isset($data['__jsonclass__'])) {
            $class = $data['__jsonclass__'];
            $reflectionClass = new \ReflectionClass($class);
            $convertedData = $reflectionClass->newInstanceArgs();
            unset($data['__jsonclass__']);
        } else {
            $convertedData = [];
        }

        if (!count($data)) {
            return $data;
        }

        foreach ($data as $property => $value) {
            $convertedValue = $this->convertArrayToObject($value);
            $setter = 'set' . $property;

            if (is_object($convertedData) && method_exists($convertedData, $setter)) {
                $convertedData->$setter($convertedValue);
            } else {
                $convertedData[$property] = $convertedValue;
            }
        }

        return $convertedData;
    }
}