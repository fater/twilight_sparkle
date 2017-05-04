<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

class TW
{
    // Set minimum length of array
    protected $amountMin = 2;

    // Set maximum length of array
    protected $amountMax = 100000;

    // Result
    protected $result = -1;

    // Data
    protected $data = [];

    /**
     * TW constructor.
     * @param int $length
     */
    public function __construct($length = 0)
    {
        // Set to min length of array
        if ($length < $this->amountMin) {
            $length = $this->amountMin;
        } elseif ($length > $this->amountMax) {
            $length = $this->amountMax;
        }

        // Create array range
        $this->data = range(1, $length);

        // Shuffle created array
        shuffle($this->data);

        $minPos = 0;
        for ($i = 0; $i < $length; $i++) {
            if ($this->data[$i] == 1) {
                $minPos = $i;
                break;
            }
        }

        for ($i = 0; $i < $length - 1; $i++) {
            if ($i + 1 < $minPos) {
                if ($this->data[$i] > $this->data[$i + 1]) {
                    return null;
                }
            } elseif ($i + 1 == $minPos) {
                if ($this->data[$i] < $this->data[$i + 1]) {
                    return null;
                }
            } elseif ($i + 1 >= $minPos) {
                if ($this->data[$i] + 1 != $this->data[$i + 1]) {
                    return null;
                }
            } elseif (0 == $minPos) {
                if ($this->data[$i] + 1 != $this->data[$i + 1]) {
                    return null;
                }
            }
        }

        $this->result = $minPos > 0 ? $length - $minPos : 0;

        return null;
    }

    /**
     * Return generated array
     *
     * @return array
     */
    public function getData()
    {
        return print_r($this->data, true);
    }

    /**
     * Return result
     *
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }
}

// Parameter sets the length of array
$instance = new TW(3);
echo '<br />Data: ' . $instance->getData();
echo '<br />Result: ' . $instance->getResult();
