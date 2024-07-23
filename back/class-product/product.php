<?php



class Product
{
    public string $name_product;

    public string $about_product;

    public string $summary;

    public int $price_client;

    private array $price;

    private static string $payment_method_visa        = 'VISA';
    private static string $payment_method_master_card = 'MASTER_CARD';



    /**
     * Summary of __construct
     * Set product name and about (fix it because i dont know what enter here.....)
     * @param string $name_product
     * @param string $about_product
     */
    public function __construct(string $name_product, string $about_product)
    {
        $this->name_product = $name_product;
        $this->about_product = $about_product;
    }





    protected static function paymentMethod()
    {

        return [
            self::$payment_method_master_card,
            self::$payment_method_master_card,
        ];
    }

    public function setMethodPeyment($method_pay)
    {
        $this->method_pay = $method_pay;
        $mathods_pay = self::paymentMethod();
        if (!empty($this->method_pay)) {
            foreach ($mathods_pay as $pay) {
                if ($pay === $method_pay) {
                    echo $pay;
                }
            }
        }
    }
    /**
     * Summary of priceModel
     * Data array with brands and prices
     * @return array
     */
    private function priceModel(): array
    {
        $brands = [
            'Asus' => 1000,
            'Samsung' => 2000,
            'Apple' => 3000,
        ];
        return $brands;
    }

    /**
     * Summary of canBuy
     * here user can 
     * @param mixed $price_client
     * @return void
     */
    public function canBuy($price_client)
    {
        $brands = $this->priceModel();
        $this->price_client = $price_client;

        if (empty($this->price_client)) {
            return;
        }


        if ($this->price_client > 0 && isset($this->price_client))
            foreach ($brands as $brand => $price) {
                if ($this->price_client === $price) {
                    echo 'You can buy ' . $brand . '';
                } else {
                    echo 'Sorry u cant buy product';
                }
            }

    }

    public function getPriceBrand()
    {
        if (empty($this->name_product)) {
            return;
        }

        try {
            $bradns = $this->priceModel();
            foreach ($bradns as $key => $value) {
                if ($key == $this->name_product) {
                    echo $value;
                }
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }


    }




}

$new_product = new Product('Apple1', 'hz');
$new_product->getPriceBrand();
$new_product->canBuy(10222);

