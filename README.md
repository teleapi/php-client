PHP Client Library
==================

## Installation
Getting going with the library is pretty simple. Just download the tar.gz file and unpack it. Then, in your code:

```
require_once('/path/to/library/BaseTele.class.php');
$token = 'your api token goes here';
```

In the library is an spl_autoload function that will grab all the individual modules if/when you need to load them.

## Modules
* Tele911
* TeleChannelGroup
* TeleDids
* TeleIpEndpoints
* TeleLnp
* TeleResellers
* TeleShoppingCart
* TeleSipAccount
* TeleSms
* TeleSubUsers
* TeleUser
* TeleUserDids
* TeleVoicemail

## Usage
Pretty much everything in each of these modules nearly exactly matches the API documentation. For instance, TeleIpEndpoint has the functions `create`, `list_endpoints`, `remove`. Note, `list_endpoints` differs from the API endpoint `list` because PHP already has a `list` function and gets angry if you try to steal it. So, any `list` functions will be `list_something`. 

All responses will have the general format:
```
stdClass Object
(
    [code] => 200
    [status] => success
    [data] => Array
        (
        )

)
```
Where data will contain appropriate data. If it is a `get` type command, typically one stdObject representing the item you're looking for. If it is a `list` type command, an array of those stdObjects. Anything that is INSERT or UPDATE like will typically just have a string in data. 



### Tele911

```
$e = new Tele911($token);
```
#### Create a new 911 entry for a phone number
`stdClass create( int $did_id, string $full_name, string $address, string $city, char(2) $state, string $zip [, string $unit_type = false [, string $unit_number = false ]] );`
```
$resp = $e->create(456, 'Bob McFrob', '234 Some Street', 'Greenwood Village', 'CO', '80111', 'apt', '1620');
print_r($resp);
```

#### Get 911 information for a phone number
`stdClass get_info( int $did_id );`
```
$resp = $e->get_info(234);
print_r($resp);
```

#### Update the 911 information for a phone number
`stdClass update( int $did_id, string $full_name, string $address, string $city, char(2) $state, string $zip [, string $unit_type = false [, string $unit_number = false ]] );`
```
$resp = $e->update(456, 'Bobby McFrobby', '321 Another Street', 'Greenwood Village', 'CO', '80111');
print_r($resp);
```

#### Remove 911 information for a number
`stdClass remove( int $did_id );`
```
$resp = $e->remove(222);
print_r($resp);
```

#### Check if the system will accept an address before trying to set it on a number
`stdClass validate( string $address, string $city, char(2) $state, string $zip )`
```
$resp = $e->validate('325 Roady Way', 'Greenwood Village', 'CO', '80111');
print_r($resp);
```

### TeleChannelGroups
```
$cg = new TeleChannelGroups($token);
```

#### Create a new channel group -- note, need to checkout to activate. See API documentation for more information
`stdClass create( string $name, int $channels );`
```
$resp = $cg->create('My Channel Group', 6);
print_r($resp);
```

#### Get information about a channel group
`stdClass get( int $channel_group_id );`
```
$resp = $cg->get(66);
print_r($resp);
```

#### List your channel groups
`stdClass list_groups();`
```
$resp = $cg->list_groups();
print_r($resp);
```

#### Update a channel group, note you can only increase number of channels. See API documentation for more information
`stdClass update( int $channel_group_id, string $name, int $channels );`
```
$resp = $cg->update(66, 'My Channel Group Renamed', 7);
print_r($resp);
```

#### Remove a channel group
`stdClass remove( int $channel_group_id );`
```
$resp = $cg->remove(66);
print_r($resp);
```

### TeleCustomers
```
$customers = new TeleCustomers($token);
```

#### Create a new customer
`stdClass create( string $username, string $password, string $email, string $first_name, string $last_name, string $phone_number, string $address, string $city, char(2) $state, string $zip );`
```
$resp = $customers->create('bob', 'change me', 'bob@mycompany.com', 'Bob', 'McFrob', '5557894560', '234 Some Street', 'Greenwood Village', 'CO', '80111');
print_r($resp);
```

#### List all of your customers
`stdClass list_customers();`
```
$resp = $customers->list_customers();
print_r($resp);
```

#### Update a customer given a customer id and an array of options. All options are optional
`stdClass update( int $customer_id, array $options );`
```
$options = array(
	'email' => 'bob+fancyfilter@mycompany.com',
	'first_name' => 'Bobby',
	'last_name' => 'McFrobby',
	'phone_number' => '5551234567',
	'address' => '456 Blargy Road',
	'city' => 'Englewood',
	'state' => 'CO',
	'zip' => '80112'
);
$resp = $customers->update(354, $options);
print_r($resp);
```

#### Enable a disabled (by you) customer 
`stdClass enable( int $customer_id );`
```
$resp = $customers->enable(354);
print_r($resp);
```

#### Disable an active customer 
`stdClass disable( int $customer_id );`
```
$resp = $customers->disable(354);
print_r($resp);
```

#### Get the set rates for a customer
`stdClass rates( int $customer_id );`
```
$resp = $customers->rates(354);
print_r($resp);
```

#### Add funds to a customer's account
`stdClass fund( int $customer_id, float $amount );`
```
$resp = $customers->fund(354, 238.00);
print_r($resp);
```

### TeleDids
```
$dids = new TeleDids($token);
```

#### List the available states on our network
`stdClass list_states();`
```
$resp = $dids->list_states();
print_r($resp);
```

#### List the available ratecenters for a given state
`stdClass list_ratecenters( char(2) $state );`
```
$resp = $dids->list_ratecenters('CO');
print_r($resp);
```

#### List the DIDs available in a given state/ratecenter with options. All options are optional
`stdClass list_dids( char(2) $state, string $ratecenter[, array $options ] );`
```
$options = array(
	'search' => '975',
	'type' => 'fax'
);
$resp = $dids->list_dids('CO', 'AURORA', $options);
print_r($resp);
```

#### See how many DIDs you have on backorder for a given state/ratecenter
`stdClass backorder_count( char(2) $state, string $ratecenter );`
```
$resp = $dids->backorder_count('CO', 'AURORA');
print_r($resp);
```

#### Add a DID to your (api) shopping cart. Pass true for $fax to mark DID as a fax number
`stdClass add_to_cart( int $did_number [, $fax = false ] );`
```
$resp = $dids->add_to_cart(5557891232);
print_r($resp);
```

#### Add an order for backorder numbers to your (api) shopping cart
`stdClass add_backorder_to_cart( char(2) $state, string $ratecenter, int $quantity);`
```
$resp = $dids->add_backorder_to_cart('CO', 'AURORA', 12);
print_r($resp);
```

#### Directly order a DID, bypassing the shopping cart process. Nastier transaction/statement management, if you care about that sort of thing. But, a simpler API call overall. All options are optional.
`stdClass direct_order( int $did_number[, array $options ] );`
```
$options = array(
	'fax' => false, // make this a fax number?
	'call_flow_id' => 5678, // if you want it to automatically go to a certain flow
	'channel_group_id' => 432, // if you want it on a certain channel group
	'voicemail_inbox_id' => 664 // I think you get the idea
);
$resp = $dids->direct_order(5556667777, $options);
print_r($resp);
```

### TeleEndpoints

```
$ipe = new TeleEndpoints($token);
```

#### Create a new IP Endpoint for use in call flows
`stdClass create( string $ip_address, string $friendly_name )`
```
$resp = $ipe->create('10.10.10.10', 'Bob\'s PBX');
print_r($resp);
```

#### List the IP Endpoints you've previously created
`stdClass list_endpoints();`
```
$resp = $ipe->list_endpoints();
print_r($resp);
```

#### Remove an IP Endpoint, note that this will break any Call Flows associated with this IP Endpoint
`stdClass remove( int $endpoint_id );`
```
$resp = $ipe->remove(654);
print_r($resp);
```

### TeleLnp

```
$lnp = new TeleLnp($token);
```

#### Create a new port request order
`stdClass create( array $numbers, int $btn, 'business' || 'residential' $location_type, string $bcontact_or_fname, string $bname_or_lname, string $acc_number, string $address, string $city, char(2) $state, string $zip, string $full_signature_path [, string $partial_details [, string $wireless_pin [, string $caller_id ]]] );`
```
$numbers = array( 5551234567, '5559876540' );
$resp = $lnp->create($numbers, 5551234567, 'business', 'Bob McFrob', 'Bob\'s Telecom', '555ASDF', '234 Telestreet', 'Englewood', 'CO', '80112', '/path/to/signature.png');
print_r($resp);

//OR

$numbers = array( 5551234567, '5559876540');
$resp = $lnp->create($numbers, 5551234567, 'residential', 'Bob', 'McFrob', '555ASDF', '243 Telestreet', 'Englewood', 'CO', '80112', '/path/to/signature.png', 'Leave other numbers on account', '5234', 'Bob McFrob');
print_r($resp);
```

#### List all of your LNP requests
`stdClass list_requests();`
```
$resp = $lnp->list_requests();
print_r($resp);
```

#### Get data about a single LNP request by ID
`stdClass get_request( int $request_id );`
```
$resp = $lnp->get_request(6547);
print_r($resp);
```

#### Check an array of number(s) to see if they can be ported to our network
`stdClass check_numbers( array $numbers );`
```
$resp = $lnp->check_numbers(array( 5557894560, '5559876540' ));
print_r($resp);
```

### TeleResellers

```
$resellers = new TeleResellers($token);
```

#### Create a new reseller
`stdClass create( string $username, string $password, string $email, string $first_name, string $last_name, string $phone_number, string $address, string $city, char(2) $state, string $zip);`
```
$resp = $resellers->create('bob', 'change me', 'bob@mycompany.com', 'Bob', 'McFrob', '5553216540', '234 Tele Way', 'Englewood', 'CO', '80112');
print_r($resp);
```

#### List all of your current resellers
`stdClass list_resellers();`
```
$resp = $resellers->list_resellers();
print_r($resp);
```

#### Update a reseller, all options are optional
`stdClass update( int $reseller_id, array $options );`
```
$options = array(
	'email' => 'bob+fancyfilter@mycompany.com',
	'first_name' => 'Bobby',
	'last_name' => 'McFrobby',
	'phone_number' => '5558521470',
	'address' => '321 Phone Street',
	'city' => 'Greenwood Village',
	'state' => 'CO',
	'zip' => '80111'
);
$resp = $resellers->update(34545, $options);
print_r($resp);
```

#### Enable a disabled (by you) reseller
`stdClass enable( int $reseller_id );`
```
$resp = $resellers->enable(4356);
print_r($resp);
```

#### Disable an active reseller
`stdClass disable( int $reseller_id );`
```
$resp = $resellers->disable(4356);
print_r($resp);
```

#### Get the currently set rates for a reseller
`stdClass rates( int $reseller_id );`
```
$resp = $resellers->rates(4356);
print_r($resp);
```

#### Add funds to a reseller's account
`stdClass fund( int $reseller_id, float $amount );`
```
$resp = $resellers->fund(4356, '238.00');
print_r($resp);
```

### TeleShoppingCart

```
$cart = new TeleShoppingCart($token);
```

#### Get your current shopping cart
`stdClass get();`
```
$resp = $cart->get();
print_r($resp);
```

#### Complete checkout with what's in your cart
`stdClass checkout();`
```
$resp = $cart->checkout();
print_r($resp);
```

#### Remove an item from the shopping cart. $item_id can be found using `$cart->get()`
`stdClass remove_item( int $item_id );`
```
$resp = $cart->remove_item(65467);
print_r($resp);
```

### TeleSipAccounts

```
$sa = new TeleSipAccounts($token);
```

#### Create a new SIP account
`stdClass create( string $username, string $password, 'server' || 'device' $type );`
```
$resp = $sa->create('bob', 'change me', 'device');
print_r($resp);
```

#### List your existing SIP accounts
`stdClass list_accounts();`
```
$resp = $sa->list_accounts();
print_r($resp);
```

#### Change the data on a created SIP account. 
`stdClass update( int $sipaccount_id, string $username, string $password, 'server' || 'device' $type );`
```
$resp = $sa->update(238, 'bobserver', 'change me', 'server');
print_r($resp);
```

#### Remove a SIP account
`stdClass remove( int $sipaccount_id );`
```
$resp = $sa->remove(238);
print_r($resp);
```

### TeleSms

```
$sms = new TeleSms($token);
```

#### Send an SMS message
`stdClass send_sms( int $source, int $destination, string $message [, string $callback_url ] );`
```
$resp = $sms->send_sms(5551234560, 5559876540, 'Hello', 'http://myserver.com/i_want_delivery_notifications.php');
print_r($resp);
```

#### Send an MMS message
`stdClass send_mms( int $source, int $destination, string $full_file_path [, string $callback_url ] );`
```
$resp = $sms->send_mms(5551234560, 5559876540, '/path/to/catpic.png', 'http://myserver.com/delivery_notifications.php');
print_r($resp);
```

### TeleSubUsers

```
$su = new TeleSubUsers($token);
```

#### Create a new Sub User
`stdClass create( string $username, string $password, string $email, string $first_name, string $last_name, string $phone_number, string $address, string $city, char(2) $state, string $zip);`
```
$resp = $su->create('bob', 'change me', 'bob@mycompany.com', 'Bob', 'McFrob', '5554564560', '123 Steet Name', 'Aurora', 'CO', '80014');
print_r($resp);
```

#### Get a list of your sub users
`stdClass list_subusers();`
```
$resp = $su->list_subusers();
print_r($resp);
```

#### Update info for a subuser, all options are optional
`stdClass update( int $subuser_id, array $options );`
```
$option = array(
	'email' => 'bob+fancyfilter@mycompany.com',
	'first_name' => 'Bobby',
	'last_name' => 'McFrobby',
	'phone_number' => 5559516230,
	'address' => '321 Blarg Ave',
	'city' => 'Aurora',
	'state' => 'CO',
	'zip' => '80017'
);
$resp = $su->update(238, $options);
print_r($resp);
```

#### Remove a sub user
`stdClass remove( int $subuser_id );`
```
$resp = $su->remove(238);
print_r($resp);
```

### TeleUser

```
$user = new TeleUser($token);
```

#### Update your own user information
`stdClass update( array $options );`
```
$options = array(

);
$resp = $user->update($options);
print_r($resp);
```

#### Change your password
`stdClass update_password( string $current_password, string $new_password );`
```
$resp = $user->update_password('this is my old password', 'this is my new password');
print_r($resp);
```

### TeleUserDids
```
$my_dids = new TeleUserDids($token);
```

#### Get a list of your phone numbers
`stdClass list_dids( [ 'local' || 'tollfree' || 'fax' || 'international' $type [, int $limit [, int $offset ]]] );`
```
$resp = $my_dids->list_dids('local');
print_r($resp);
```

#### Remove a phone number from your account
`stdClass remove( int $did_id );`
```
$resp = $my_dids->remove(238);
print_r($resp);
```

#### Assign a number to a different customer/reseller under you
`stdClass assign ( int $did_id, int $new_owner_id )`
```
$resp = $my_dids->assign(238, 6544);
print_r($resp);
```

#### Add a number to a call flow
`stdClass set_flow( int $did_id, int $flow_id );`
```
$resp = $my_dids->set_flow(238, 6433);
print_r($resp);
```

#### Add a number to a channel group
`stdClass set_channel_group( int $did_id, int $channel_group_id );`
```
$resp = $my_dids->set_channel_group(238, 5322);
print_r($resp);
```

#### Add a voicemail inbox to a number
`stdClass set_voicemail_inbox( int $did_id, int $voicemail_inbox_id );`
```
$resp = $my_dids->set_voicemail_inbox(238, 6322);
print_r($resp);
```

#### Convert a voice number to a fax number
`stdClass convert_to_fax( int $did_id );`
```
$resp = $my_dids->convert_to_fax(238);
print_r($resp);
```

#### Convert a fax number to a voice number
`stdClass convert_to_voice( int $did_id );`
```
$resp = $my_dids->convert_to_voice(238);
print_r($resp);
```

### TeleVoicemail

```
$vm = new TeleVoicemail($token);
```

#### Create a new voicemail inbox
`stdClass create_inbox( string $name, int $inbox_number, int(4) $pin [, boolean $transcribe ] );`
```
$resp = $vm->create_inbox('My New Inbox', 4567, 9999, true);
print_r($resp);
```

#### Get details about a voicemail inbox
`stdClass get_inbox( int $inbox_id );`
```
$resp = $vm->get_inbox(238);
print_r($resp);
```

#### List your voicemail inboxes
`stdClass list_inboxes();`
```
$resp = $vm->list_inboxes();
print_r($resp);
```

#### Update metadata for a voicemail inbox
`stdClass update_inbox( int $inbox_id, string $name, int $inbox_number, int(4) $pin, boolean $transcribe );`
```
$resp = $vm->update_inbox(238, 'Bob', 5432, 1111, false);
print_r($resp);
```
