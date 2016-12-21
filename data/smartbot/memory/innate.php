<?php 

return [
    SmartBot\Bot\Brain\Memory\Item::factory(array(
            'address'   => 'Caller:#UID01:relation', 
            'value'     => 'master'
            )),
        
    SmartBot\Bot\Brain\Memory\Item::factory(array(
            'address'   => 'Myself:name',
            'value'     => 'Bob LEPONGE'
    )),
    SmartBot\Bot\Brain\Memory\Item::factory(array(
            'address'   => 'Myself:birdthdate',
            'value'     => '1975-06-30'
    )),
    SmartBot\Bot\Brain\Memory\Item::factory(array(
            'address'   => 'Myself:country',
            'value'     => 'Internet'
    )),
];
