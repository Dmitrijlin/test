<?php

$text = <<<END
<?php

namespace App;

class TestFile%s
{

}
END;


for ($i = 1; $i <= 100; $i++) {
    file_put_contents('./app/TestFile' . $i . '.php', sprintf($text, $i));
}