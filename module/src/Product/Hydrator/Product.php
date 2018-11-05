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
        if ($object->getId()>=0) {
            $data['idproduit'] = $object->getId();
        }
        if ($object->getName()) {
            $data['libelle'] = $object->getName();
        }
        if ($object->getPrice()>=0) {
            $data['prix'] = $object->getPrice();
        }
        if ($object->getReduction()>=0) {
            $data['reduction'] = $object->getReduction();
        }
        if ($object->getIdfamilly()) {
            $data['idcategorie'] = $object->getIdfamilly();
        }
        if ($object->getQuantity()) {
            $data['quantitestock'] = $object->getQuantity();
        }
        if ($object->getEstDisponible() === True) {
            $data['estdisponible'] = $object->getEstDisponible();
        }
        return $data;
    }
    public function hydrate(array $data, \Product\Entity\Product $emptyEntity): \Product\Entity\Product
    {
        return $emptyEntity
            ->setId($data['idproduit'] ?? null)
            ->setName(strtolower($data['libelle']) ?? null)
            ->setPrice($data['prix'] ?? 0 )
            ->setReduction($data['reduction'] ?? 0)
            ->setQuantity($data['quantitestock'] ?? 0 )
            ->setEstDisponible($data['estdisponible'] ?? True)
            ->setIdfamilly($data['idcategorie'] ?? null);
    }
}
?>
