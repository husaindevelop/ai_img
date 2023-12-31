<?php
use App\Models\ai_images;

$key = env("OPENAI_KEY", false);

class img
{
private $key;

public function __construct($key)
{
$this->key=$key;
}
 
public function call_img ($input)
{   
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/images/generations');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//following two lines only used for localhost, should not be used in production
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"model\": \"dall-e-2\",\n    \"prompt\": \"".urlencode($input)."\",\n    \"n\": 1,\n    \"size\": \"1024x1024\"\n  }");
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer '.$this->key.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
else {
return json_decode ($result);   
}
curl_close($ch);
} 
}

//Invoking of class

$im=new img($key);
$imgs=$im->call_img ($input);
$gen = ai_images::where('img_id',$id)->first();
?>

<?php  //generated imaged  ?>
<div class="row align-items-end">
<div class="col-8 "><i>image generated at <?=$gen->updated_at; ?></i></div>
<div class="col-4 text-right"> 
<a href="javascript:void (0)" onclick="$('#ai_form').trigger('reset');$('#ai_img').html ('');" class="btn btn-outline-primary">Reset</a>
</div>
</div>
<div class="border rounded" id="imgn" style="height:300px;">
<img src="<?php echo $imgs->data[0]->url; ?>" class="img-fluid">
</div>
