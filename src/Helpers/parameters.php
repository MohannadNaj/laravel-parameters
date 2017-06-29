<?php
// return parameters collection, or a specified parameter value
if (! function_exists('param')) {
    function param($name = false)
    {
        // if we are using the method to return a specified parameter value, e.g: param('some_param')
        if ($name) {
            return app('parameter')->where('name', $name)->first()->getValue();
        }

        // if the method is used to return the parameters collection
        return app('parameter');
    }
}
