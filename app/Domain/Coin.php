<?php


namespace App\Domain;

/**
 * Class Coin
 * @package App\Domain
 */
class Coin implements \JsonSerializable {

    private CoinId $id;
    private string $name;
    private string $fullName;
    private float $currentPrice;
    private string $lastRetrievedAt;
    private string $currentPriceFormatted;
    private float $openingPrice;
    private string $openingPriceFormatted;
    private float $priceIncrease;
    private string $priceIncreaseFormatted;
    private float $priceIncreasePercentage;
    private string $priceIncreasePercentageFormatted;

    /**
     * @param CoinId $id
     * @param string $name
     * @param string $fullName
     * @param float $currentPrice
     * @param string $lastRetrievedAt
     * @param string $currentPriceFormatted
     * @param float $openingPrice
     * @param string $openingPriceFormatted
     * @param float $priceIncrease
     * @param string $priceIncreaseFormatted
     * @param float $priceIncreasePercentage
     * @param string $priceIncreasePercentageFormatted
     * @return Coin
     */
    public static function draft(CoinId $id, string $name, string $fullName, float $currentPrice,
        string $lastRetrievedAt, string $currentPriceFormatted,float $openingPrice,string $openingPriceFormatted,
           float $priceIncrease, string $priceIncreaseFormatted, float $priceIncreasePercentage, string $priceIncreasePercentageFormatted): Coin
    {
        return new self(
            $id,
            $name,
            $fullName,
            $currentPrice,
            $lastRetrievedAt,
            $currentPriceFormatted,
            $openingPrice,
            $openingPriceFormatted,
            $priceIncrease,
            $priceIncreaseFormatted,
            $priceIncreasePercentage,
            $priceIncreasePercentageFormatted
        );
    }

    /**
     * @param array $state
     * @return Post
     */
    public static function fromState(array $state): Coin
    {
        return new self(
            CoinId::fromInt($state['id']),
            $state['name'],
            $state['fullName'],
            $state['currentPrice'],
            $state['lastRetrievedAt'],
            $state['currentPriceFormatted'],
            $state['openingPrice'],
            $state['openingPriceFormatted'],
            $state['priceIncrease'],
            $state['priceIncreaseFormatted'],
            $state['priceIncreasePercentage'],
            $state['priceIncreasePercentageFormatted']
        );
    }

    /**
     * Coin constructor.
     * @param CoinId $id
     * @param string $name
     * @param string $fullName
     * @param float $currentPrice
     * @param string $lastRetrievedAt
     * @param string $currentPriceFormatted
     * @param float $openingPrice
     * @param string $openingPriceFormatted
     * @param float $priceIncrease
     * @param string $priceIncreaseFormatted
     * @param float $priceIncreasePercentage
     * @param string $priceIncreasePercentageFormatted
     */
    private function __construct(CoinId $id, string $name, string $fullName, float $currentPrice, string $lastRetrievedAt,
            string $currentPriceFormatted,float $openingPrice,string $openingPriceFormatted, float $priceIncrease,
               string $priceIncreaseFormatted, float $priceIncreasePercentage, string $priceIncreasePercentageFormatted) {
        $this->id = $id;
        $this->name = $name;
        $this->fullName = $fullName;
        $this->currentPrice = $currentPrice;
        $this->lastRetrievedAt = $lastRetrievedAt;
        $this->currentPriceFormatted = $currentPriceFormatted;
        $this->openingPrice = $openingPrice;
        $this->openingPriceFormatted = $openingPriceFormatted;
        $this->priceIncrease = $priceIncrease;
        $this->priceIncreaseFormatted = $priceIncreaseFormatted;
        $this->priceIncreasePercentage = $priceIncreasePercentage;
        $this->priceIncreasePercentageFormatted = $priceIncreasePercentageFormatted;

    }

    /**
     * @return CoinId
     */
    public function getId(): CoinId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return float
     */
    public function getCurrentPrice(): float {
        return $this->currentPrice;
    }

    /**
     * @return string
     */
    public function getLastRetrievedAt(): string {
        return $this->lastRetrievedAt;
    }

    /**
     * @return string
     */
    public function getCurrentPriceFormatted(): string {
        return $this->currentPriceFormatted;
    }

    /**
     * @return float
     */
    public function getOpeningPrice(): float {
        return $this->openingPrice;
    }

    /**
     * @return string
     */
    public function getOpeningPriceFormatted(): string {
        return $this->openingPriceFormatted;
    }

    /**
     * @return float
     */
    public function getPriceIncrease(): float {
        return $this->priceIncrease;
    }

    /**
     * @return string
     */
    public function getPriceIncreaseFormatted(): string {
        return $this->priceIncreaseFormatted;
    }

    /**
     * @return float
     */
    public function getPriceIncreasePercentage(): float {
        return $this->priceIncreasePercentage;
    }

    /**
     * @return string
     */
    public function getPriceIncreasePercentageFormatted(): string {
        return $this->priceIncreasePercentageFormatted;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id'                    => $this->id->toInt(),
            'name'                  => $this->name,
            'fullName'              => $this->fullName,
            'currentPrice'          => $this->currentPrice,
            'lastRetrievedAt'       => $this->lastRetrievedAt,
            'currentPriceFormatted' => $this->currentPriceFormatted,
            'openingPrice'          => $this->openingPrice,
            'openingPriceFormatted' => $this->openingPriceFormatted,
            'priceIncrease'         => $this->priceIncrease,
            'priceIncreaseFormatted' => $this->priceIncreaseFormatted,
            'priceIncreasePercentage' => $this->priceIncreasePercentage,
            'priceIncreasePercentageFormatted' => $this->priceIncreasePercentageFormatted
        ];
    }

}
