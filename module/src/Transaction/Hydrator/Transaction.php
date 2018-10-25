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
            $data['datecommande'] = $object->getDate()->format('Y\-m\-d\ h:i:s');
        }
        if ($object->getPrice()>=0) {
            $data['prixtotal'] = $object->getPrice();
        }
        if ($object->getBarmen()) {
            $data['idbarmen'] = $object->getBarmen()->getId();
        }
        if ($object->getClient()) {
            $data['idutilisateur'] = $object->getClient()->getId();
        }
        if ($object->getProduct()) {
            $data['products'] = $object->getProduct();
        }
        return $data;
    }
    public function hydrate(array $data, \Transaction\Entity\Transaction $emptyEntity): \Transaction\Entity\Transaction
    {
//        $madate=\DateTime::createFromFormat('Y-m-d h:i:s', $data['datecommande']);

        return $emptyEntity
            ->setId($data['idcommande'] ?? null)
            ->setDate($data['datecommande'] ?? null)
            ->setPrice($data['prixtotal'] ?? null)
            ->setBarmen($data['idbarmen'] ?? null)
            ->setClient($data['idutilisateur'] ?? null)
            ->setProduct($data['products'] ?? null);
    }
}
?>

}