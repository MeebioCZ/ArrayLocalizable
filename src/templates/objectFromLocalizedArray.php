/**
* Fill object from localized array
*
*/
public function fromLocalizedArray(array $array) : void
{
    <?php
        foreach ($setterMethods as $key => $method) {
            $line = "   
            if (array_key_exists('$key', \$array)) {
                \$this->$method(\$array['$key']);
            }";
            echo $line;
        }
    ?>
}
