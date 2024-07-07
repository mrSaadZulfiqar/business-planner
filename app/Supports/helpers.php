<?php
use Akaunting\Money\Money;
function formatCurrency($amount, $isoCode)
{
    if (!$amount) {
        return $amount;
    }
    $decimalPoint = currency($isoCode)->getDecimalMark();

    if ($decimalPoint == ",") {
        $amount = str_replace(".", ",", $amount);
    }

    return Money::$isoCode($amount, true)->format();
}

function lightPath($path)
{
    return base_path('/lights/'.config('app.uid').'/'.$path);
}
function getWorkspaceCurrency($settings)
{
    return $settings['currency'] ?? config('app.currency');
}


function getClientIP()
{
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }

    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $client_ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

        return $client_ips[0];
    }

    if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        return $_SERVER['HTTP_X_FORWARDED'];
    }

    if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }

    if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_FORWARDED_FOR'];
    }

    if (isset($_SERVER['HTTP_FORWARDED'])) {
        return $_SERVER['HTTP_FORWARDED'];
    }

    if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return 'UNKNOWN';
}

function setEnvironmentValue($envKey, $envValue)
{
    $path = base_path('.env');

    if(is_bool(env($envKey)))
    {
        $envValue = env($envKey) ? 'true' : 'false';
    }

    if(file_exists($path))
    {
        // Make sure we are dealing with string to escape any special characters
        $envValue = is_string($envValue) ? "'$envValue'" : $envValue;

        // Get the current .env content
        $envContent = file_get_contents($path);

        // If the key exists already, replace the existing value
        if(preg_match("/^{$envKey}=.+$/m", $envContent))
        {
            file_put_contents($path, preg_replace(
                "/^{$envKey}=.+$/m",
                "{$envKey}={$envValue}",
                $envContent
            ));
        }
        // If the key does not exist, add it to the end of the file
        else
        {
            file_put_contents($path, $envContent . PHP_EOL . "{$envKey}={$envValue}");
        }
    }
}

function setEnvironmentValues($values)
{
    foreach ($values as $key => $value) {
        setEnvironmentValue($key, $value);
    }
}
