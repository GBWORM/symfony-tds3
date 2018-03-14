<?php
/**
 * Created by PhpStorm.
 * User: Gabin Challe
 * Date: 14/03/2018
 * Time: 14:02
 */

namespace App\Services\semantic;
use Ajax\php\symfony\JquerySemantic;
use Ajax\semantic\html\base\constants\Color;
use Ajax\semantic\html\elements\HtmlLabel;
use App\Entity\Developer;
class DevelopersGui extends JquerySemantic
{
    public function dataTable($devs){
        $dt=$this->_semantic->dataTable("dtDevs", "App\Entity\Developer", $devs);
        $dt->setFields(["identity"]);
        $dt->setCaptions(["Identity"]);
        $dt->setValueFunction("identity", function($v,$dev){
            $lbl=new HtmlLabel("",$dev->getIdentity());
            return $lbl;
        });
        $dt->addEditButton();
        $dt->setUrls(["edit"=>"developers/update"]);
        $dt->setTargetSelector("#update-dev");
        return $dt;
    }
    public function frm(){
        $frm=$this->_semantic->dataForm("frm-dev",new Developer());
        $frm->setFields(["id","identity","submit","cancel"]);
        $frm->setCaptions(["","Identity","Inserer","Annuler"]);
        $frm->fieldAsHidden("id");
        $frm->fieldAsInput("identity",["rules"=>["empty","maxLength[30]"]]);
        $frm->setValidationParams(["on"=>"blur","inline"=>true]);
        $frm->onSuccess("$('#frm-dev').hide();");
        $frm->fieldAsSubmit("submit","positive","developers/submit", "#dev-view",["ajax"=>["attr"=>"","jqueryDone"=>"replaceWith"]]);
        $frm->fieldAsLink("cancel",["class"=>"ui button cancel"]);
        $this->click(".cancel","$('#frm-dev').hide();");
        return $frm;
    }

    public function frm_m(Developer $dev){
        $frm=$this->_semantic->dataForm("frm-dev", $dev);
        return $frm;
    }
}