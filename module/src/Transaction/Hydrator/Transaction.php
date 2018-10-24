<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 24/10/18
 * Time: 22:29
 */
namespace Transaction\Hydrator;
/**
 * Class Product
 * @package \Transaction\Hydrator
 */
class Transaction
{
    public function extract(\Transaction\Entity\Transaction $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['idtransaction'] = $object->getId();
        }
        if ($object->getDate()) {
            $data['date'] = $object->getDate();
        }
        if ($object->getPrice()>=0) {
            $data['price'] = $object->getPrice();
        }
        if ($object->getReduction()) {
            $data['barmen'] = $object->getBarmen();
        }
        if ($object->getIdfamilly()) {
            $data['client'] = $object->getClient();
        }
        if ($object->getQuantity()) {
            $data['product'] = $object->getProduct();
        }
        return $data;
    }
    public function hydrate(array $data, \Transaction\Entity\Transaction $emptyEntity): \Transaction\Entity\Transaction
    {
        return $emptyEntity
            ->setId($data['idtransaction'] ?? null)
            ->setDate($data['date'] ?? null)
            ->setPrice($data['price'] ?? null )
            ->setBarmen($data['barmen'] ?? null)
            ->setClient($data['client'] ?? null)
            ->setProduct($data['product'] ?? null);
    }
}
?>

}