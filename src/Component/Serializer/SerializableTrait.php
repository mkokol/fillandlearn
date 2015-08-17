<?php
namespace Component\Serializer;

use Component\Serializer\Normalizer\RecursiveClassNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

trait SerializableTrait
{
    /** @var Serializer $serializer */
    private static $serializer = null;

    public static function initSerializer()
    {
        if (!self::$serializer) {
            $encoders = [new JsonEncoder()];
            $normalizers = [new RecursiveClassNormalizer()];
            self::$serializer = new Serializer($normalizers, $encoders);
        }
    }

    public function serialize()
    {
        self::initSerializer();

        return self::$serializer->serialize($this, 'json');
    }

    public static function deserialize($jsonData)
    {
        self::initSerializer();

        return self::$serializer->deserialize($jsonData, null, 'json');
    }
}