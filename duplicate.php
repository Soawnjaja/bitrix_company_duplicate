<?php 

  $method = 'crm.company.list';
  $queryUrl = 'https://'.$_REQUEST['DOMAIN'].'/rest/'.$method.'.json';
  $params = [ 
    'select' => ['ID', 'TITLE', 'EMAIL', 'PHONE', 'WEB']
  ];
  $queryData = http_build_query(array_merge($params, array("auth" => $_REQUEST['AUTH_ID'])));
  /
  $curl = curl_init();
   curl_setopt_array($curl, array(
    CURLOPT_SSL_VERIFYPERR => 0,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $queryUrl,
    CURLOPT_POSTFIELDS => $queryData,
   ));

   $result = json_decode(curl_exec($curl), true);
   curl_close($curl);
   out($result);

// out data
  function out ($var, $var_name = '') {
    // out style.
    echo '<pre style = "outline: 1px solid red;
    padding: 0.5 em;
    margin: 10px; 
    color: white; 
    background: #000;"';
    if( ! empty ($var_name)) {
      echo '<h3>' .  $var_name . '</h3>';
    }
    if(is_string($var)) {
      $var = htmlspecialchars($var);
    }

    print_r($var);
    echo '</pre>';
  }

//table style.
<style>table{border-collapse: collapse;}</style>
<table border="1">
    <tr>
      <th>ID</th>
      <th>Название</th>
      <th>Телефоны</th>
      <th>Emails</th>
      <th>Домены</th>
      <th>Cвязи</th>
      <th>Действия</th>
    </tr>
    <?php foreach ($result['result'] as $company) { ?>

    <tr>
      <td><?=$company['ID']?></td>
      <td><?=$company['TITLE']?></td>
      <td><?=$company['PHONE']?></td>
      <td>Emails</td>
      <td>Домены</td>
      <td>Cвязи</td>
      <td>Объеденить</td>
    </tr>
    <?php } ?>
</table>
