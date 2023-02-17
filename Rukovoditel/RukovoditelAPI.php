<? PHP
//Rukovoditel API for TST

namespace MauticPlugin\RukovoditelBundle\Api;

use Mautic\PluginBundle\Api\AbstractApi;
use MauticPlugin\RukovoditelBundle\Integration\RukovoditelIntegration;


class RukovoditelAPI extends AbstractApi
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'https://massivehand.com/pm/tst/api/rest.php';
}

public function __construct(RukovoditelIntegration $integration)
{
    parent::__construct($integration);
}

public function insertContact(array $data)
{
    $url = $this->baseUrl . $this->url;

    $params = [
        'element' => 'contact',
        'firstname' => $data['firstname'],
        'lastname' => $data['lastname'],
        'email' => $data['email']
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);

    return $server_output;
}


public function updateContact($id, array $data)
{
    $params = [
        'action' => 'update',
        'entity_id' => '1', // Replace with the entity ID for contacts in Rukovoditel
        'id' => $id,
    ];
    
    foreach ($data as $field => $value) {
        $params['items[' . $field . ']'] = $value;
    }
    
    $response = $this->makeRequest($params);
    
    return $response;
}

protected function makeRequest(array $params)
{
    $url = $this->getEndpoint() . http_build_query($params);
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = [
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    // Use OAuth2 authentication for the request here
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    return $response;
}

class Rukovoditel extends CRMApi

use Mautic\PluginBundle\Helper\IntegrationHelper;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\CrmBundle\Api\AbstractCrmApi;

class RukovoditelAPI extends AbstractCrmApi
{
    private $helper;

    public function __construct(IntegrationHelper $helper, $baseUrl, $username, $password)
    {
        parent::__construct($helper, $baseUrl, $username, $password);
        $this->setUrl('/api/rest.php');
    }
    
    // ...
}

public function insertLead(Lead $lead)
{
    $params = array(
        'key'       => $this->key,
        'action'    => 'insert',
        'entity_id' => 1, // Assuming you want to insert the lead into the "Leads" entity
        'notify'    => false,
        'login_url' => $this->baseUrl . '/index.php?module=users/login',
        'items'     => array(
            'field_5'  => $lead->getPrimaryIdentifier(),
            'field_6'  => $lead->getFirstName(),
            'field_7'  => $lead->getLastName(),
            'field_8'  => $lead->getEmail(),
            'field_9'  => $lead->getCompany(),
            'field_10' => $lead->getCity(),
            // Add any additional fields you want to insert
        ),
    );
    
    $response = $this->post($this->getUrl(), $params);
    
    return $response;
}
public function createContact(Lead $lead, $objects)
{
    $data = array(
        'entity_id' => $objects['entity_id'],
        'notify' => $objects['notify'],
        'items' => array(
            'field_5' => $lead->getFieldValue('company'),
            'field_7' => $lead->getFieldValue('firstname'),
            'field_8' => $lead->getFieldValue('lastname'),
            'field_9' => $lead->getFieldValue('email'),
            'field_14' => $lead->getFieldValue('phone'),
            'field_6' => $lead->getFieldValue('title'),
        ),
    );

    return $this->makeRequest('insert', $data);
}

public function prepareRequestData($data)
{
    $params = [
        'key' => $this->credentials['key'],
        'username' => $this->credentials['username'],
        'password' => $this->credentials['password'],
        'action' => 'insert',
        'entity_id' => $this->config['entity_id'],
        'notify' => $this->config['notify'] ? 'true' : 'false',
        'items' => []
    ];
    
    foreach ($data as $field => $value) {
        $params['items'][$field] = $value;
    }

    return http_build_query($params);
}

public function insertLead(Lead $lead, $newLead = false)
{
    $fields = [
        'field_5' => 'Active',
        'field_14' => 'Default',
        'field_201' => $lead->getDateAdded()->format('Y-m-d'),
        'field_6' => 1,
        'field_12' => 'Mautic',
        'field_7' => $lead->getFirstName(),
        'field_8' => $lead->getLastName(),
        'field_9' => $lead->getEmail(),
        'password' => 'secretpassword'
    ];

    $data = [
        'entity_id' => 1,
        'notify' => false,
        'items' => [$fields]
    ];

    $response = $this->makeRequest('/item/create', 'POST', $data);
    $json = json_decode($response, true);

    return $json['success'];
}

public function insertLead(array $leadData)
{
    $data = [
        'key' => $this->getAuthKey(),
        'username' => $this->getAuthUsername(),
        'password' => $this->getAuthPassword(),
        'action' => 'insert',
        'entity_id' => 1, // Change entity_id to the ID of the entity you want to insert into
        'notify' => false,
        'items' => [],
    ];

    // Map the lead fields to the Rukovoditel fields
    $data['items'] = [
        'field_5' => 'Active',
        'field_14' => 'Default',
        'field_201' => $leadData['date_added'],
        'field_6' => $leadData['ip'],
        'field_12' => $leadData['created_by'],
        'field_7' => $leadData['firstname'],
        'field_8' => $leadData['lastname'],
        'field_9' => $leadData['email'],
        'password' => 'secretpassword', // Change this to the password field in Rukovoditel
    ];

    $url = $this->baseUrl . $this->url;

    $response = $this->postRequest($url, $data);

    return $response;
}

public function insertObject($object)
{
    $data = array(
        'key'        => $this->credentials['key'],
        'username'   => $this->credentials['username'],
        'password'   => $this->credentials['password'],
        'action'     => 'insert',
        'entity_id'  => '1',
        'notify'     => 'false',
        'items'      => array(
            'field_5'   => $object['status'],
            'field_14'  => 'Default',
            'field_201' => $object['date'],
            'field_6'   => '1',
            'field_12'  => $object['user'],
            'field_7'   => $object['first_name'],
            'field_8'   => $object['last_name'],
            'field_9'   => $object['email'],
            'password'  => $object['password']
        )
    );
    
    $response = $this->post('', $data);
    return json_decode($response, true);
}


?>