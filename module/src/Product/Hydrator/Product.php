<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 17/10/18
 * Time: 17:42
 */
namespace Product\Hydrator;
/**
 * Class Product
 * @package Product\Hydrator
 */
class Product{
    public function extract(\Product\Entity\Product $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['id'] = $object->getId();
        }
        if ($object->getName()) {
            $data['nickname'] = $object->getName();
        }
        if ($object->getPrice()) {
            $data['password'] = $object->getPrice();
        }
        if ($object->getReduction()) {
            $data['created_at'] = $object->getReduction();
        }
        if ($object->getIdfamilly()) {
            $data['updated_at'] = $object->getIdfamilly();
        }
        if ($object->getQuantity()) {
            $data['updated_at'] = $object->getQuantity();
        }
        return $data;
    }
    public function hydrate(array $data, \Product\Entity\Product $emptyEntity): \Product\Entity\Product
    {
        return $emptyEntity
            ->setId($data['id'] ?? null)
            ->setName($data['name'] ?? null)
            ->setPrice($data['price'] ?? null)
            ->setReduction($data['reduction'] ?? null)
            ->setIdfamilly($data['idfamilly'] ?? null)
            ->setQuantity($data['quantity'] ?? null);
    }
}
?>
