<?php

namespace PrestaShop\Module\PsFixturesCreator\Creator;

use Cart;
use Faker\Generator as Faker;
use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\Cart\Command\AddProductToCartCommand;

class CartCreator
{
    protected Faker $faker;

    protected CommandBusInterface $commandBus;

    public function __construct(Faker $faker, CommandBusInterface $commandBus)
    {
        $this->faker = $faker;
        $this->commandBus = $commandBus;
    }

    public function generate(int $number, array $productIds): void
    {
        for ($i = 0; $i < $number; ++$i) {
            $this->createCart($productIds);
        }
    }

    public function createCart(array $productIds): Cart
    {
        $cart = new Cart(17);
        /*$cart->id_currency = 1;
        $cart->id_customer = 3;
        $cart->add();*/

        $numberOfProducts = 1200;

        for ($i = 630; $i < $numberOfProducts; $i++) {
            $this->commandBus->handle(new AddProductToCartCommand(
                $cart->id,
                $i,
                1,
                 null,
                []
            ));
            //$cart->updateQty($this->faker->numberBetween(1, 3), $i);
        }

        /*for ($i = 0; $i < $this->faker->numberBetween(1, 5); ++$i) {
            //$randomProduct = $this->faker->randomElement($productIds);


        }*/

        return $cart;
    }
}
