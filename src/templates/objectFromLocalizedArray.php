/**
* Fill object from localized array
*
*/
public function fromLocalizedArray(array $array) : void
{
    <?php
        foreach ($setterMethods as $key => $method) {
            $line = "   
            if (isset(\$array['$key'])) {
                \$this->$method(\$array['$key']);
            }";
            echo $line;
        }
    ?>
}
