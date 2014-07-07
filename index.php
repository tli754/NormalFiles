<div class="wrapinside homebg">
    <div class="container">
        <div class="row">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1><?php echo $this->t('index', 'Header');?></h1>
        <h2><?php echo $this->t('index', 'SubHeader');?></h2>
      </div>
      </div>
    <div class="row">
      <!-- Example row of columns -->
      <div class="row">
        <div class="span6" id="home-quote-form">
            <a href="#" class="hometab getaquote" id="getaquote" onclick="return false;"><?php echo $this->t('index', 'TabGetQuote');?></a>
            <a href="#" class="hometab compareprices" id="compareprices" onclick="return false;"><?php echo $this->t('index', 'TabCompare');?></a>
            <div class="box formbox01">
                 <?php
                     echo $this->renderPartial('_detailsForm', array(
                        'model'=>$model,
                        'error'=>$error,
                     ));
                 ?>

                <div class="comparison-tab" style="display:none;">
                    <label class="left" style="margin-top:5px;"><?php echo $model->getAttributeLabel('CountryId');?></label>
                    <select class="left" id="select-comparison-country" style="margin:0px 10px; width:auto !important; max-width:300px;">
                        <option value="">--<?php echo $this->t('index', 'SelectCountry');?>--</option>
                        <?php
                        foreach (Country::model()->findAll() as $country)
                        {
                            echo '<option value="' . $country->CountryId . '" ' . ($country->Code == 'AU' ? 'selected="selected"' : '') . '>' . $country->Name . '</option>';
                        }
                        ?>
                    </select>
                    <input type="button" value="Show Comparison" class="left display-btn display-btn-small" id="compare-submit" style="width:auto !important;" />

                    <div style="float:left; display:none; margin:3px 5px;" class="comparison-loader">
                        <img src="<?php echo $this->getCommonImagesPath('ajax-loader.gif'); ?>" alt="loading..." />
                    </div>

                    <div class="clear"></div>

                    <div id="comparison-options" class="clear"><?php // Populated via AJAX ?></div>

                    <div class="clear"></div>

                </div>
            </div>
        </div>
        <div class="span4 howitworks-display" id="how-it-works">
            <a href="#" class="hometab howitworks"><?php echo $this->t('index', 'TabHowItWorks');?></a>
            <div class="box formbox03">
                <div class="video">
                    <div id="slides" class="left">
                        <div class="slideshow-div" style="background-position:0 0;"><a href="#" class="slideshow-div-link slidesjs-next"></a></div>
                        <div class="slideshow-div" style="background-position:-268px 0;"><a href="#" class="slideshow-div-link slidesjs-next"></a></div>
                        <div class="slideshow-div" style="background-position:0 -212px;"><a href="#" class="slideshow-div-link slidesjs-next"></a></div>
                        <div class="slideshow-div" style="background-position:-268px -212px;"></div>
                        <a href="#" class="slidesjs-previous slidesjs-navigation" style="left:0;"><img src="<?php echo $this->getImagesPath('slideshow-control-left.jpg'); ?>" alt="<" border="0" /></a>
                        <a href="#" class="slidesjs-next slidesjs-navigation" style="right:0;"><img src="<?php echo $this->getImagesPath('slideshow-control-right.jpg'); ?>" alt=">" border="0" /></a>
                    </div>
                </div>

                <div class="video_featured"><?php echo $this->t('index', 'FeaturedIn');?>:</div>
                <div class="video_logo">
                    <img src="<?php echo $this->getImagesPath('rc_featuredlogo_brw_104x50.png'); ?>">
                    <img src="<?php echo $this->getImagesPath('rc_featuredlogo_newscomau_104x50.png'); ?>">
                    <img src="<?php echo $this->getImagesPath('rc_featuredlogo_smh_104x50.png'); ?>">
                    <img src="<?php echo $this->getImagesPath('rc_featuredlogo_kayak_104x50.png'); ?>">
                    <img src="<?php echo $this->getImagesPath('rc_featuredlogo_expedia_104x50.png'); ?>">
                    <img src="<?php echo $this->getImagesPath('rc_featuredlogo_sta_104x50.png'); ?>">
                </div>
            </div>
        </div>
    </div>
  </div><!-- /row -->

    <div class="row-fluid partners-display">
        <div class="span12">
            <div class="row-fluid" style="margin-top: 10px; margin-bottom: 20px; background-color:#fff; border-radius:5px; width: 962px">
                <div class="span5">
                    <h4 style="padding-left:10px;"><?php echo $this->t('index', 'Partners'); ?></h4>
                    <div class="text-left" style="padding-bottom:20px;padding-left: 10px;">
                        <img style="margin-right:55px" src="<?php echo $this->getImagesPath('rc_logo_qbe_51x58.gif');?>" />
                        <img style="margin-right:55px" src="<?php echo $this->getImagesPath('rc_logo_zurich_89x58.gif');?>" />
                        <img src="<?php echo $this->getImagesPath('rc_log_chubb_70x58.gif');?>" />
                    </div>
                </div>

                <div class="span4">
                    <h4 style="padding-left:10px;"><?php echo $this->t('index', 'PointsPartners'); ?><span id="selected-policies">(<?php echo $this->t('index', 'SelectedPolicies'); ?>)</span></h4>
                    <div></div>

                    <div class="text-left" style="padding-bottom:20px;padding-left:10px;">
                        <img src="<?php echo $this->getImagesPath('rc_log_qantas_251x58.gif');?>" />
                    </div>
                </div>

                <div class="span3 ">
                    <h4><?php echo $this->t('index', 'RentalDaysCovered'); ?></h4>
                    <div class="text-left" style="padding-top:15px;">
                        <span class="day_counter" id="cover-counter"><?php echo $covered_mount ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- /container -->


</div><!-- /wrapinside -->

<?php echo $this->renderPartial('/site/_contentBottom'); ?>

<script type="text/javascript" src="<?php echo $this->getCommonJsPath('jquery.slides.min.js'); ?>"></script>
<script type="text/javascript">

$(document).ready(function(){
    callComparisons();

    setInterval(function() {
            $.ajax({
            url: "<?php echo $this->createUrl('CoverDayCounter'); ?>",
            success: function(content){
                $('#cover-counter').text(content);
            }
        });
    }, 30000);
});

$('#getaquote').click(function(){
    $('#hp-form').show();
    $('#getaquote-btn').show();
    $('.comparison-tab').hide();
    $(this).css('background-color', '#3AC7BF');
    $(this).css('color', '#fff');
    $('#compareprices').css('background-color', '#288B85');
    $('#compareprices').css('color', '#B2B2B2');
    $('.errorSummary').hide();
    $('.counterrow').show();

    $('#hp-login-form').hide();
    checkCustomerAccount($('#QuoteForm_Email').val());
});

$('#compareprices').click(function(){
    $('#hp-form').hide();
    $('#getaquote-btn').hide();
    $('.comparison-tab').show();
    $(this).css('background-color', '#3AC7BF');
    $(this).css('color', '#fff');
    $('#getaquote').css('background-color', '#288B85');
    $('#getaquote').css('color', '#B2B2B2');
    $('.errorSummary').hide();
    $('.counterrow').hide();
});

$(function() {
    $('#slides').slidesjs({
        width: 268,
        height: 212,
        navigation: false
    });
});

$('#compare-submit').click(function(){
    callComparisons();
});

function callComparisons()
{
    $('#comparison-options').hide();

    if ($('#select-comparison-country').val() && $('#select-comparison-country').val() != '')
    {
        $('.comparison-loader').show();

        $.ajax({
            url: "<?php echo $this->createUrl('displayStaticComparisons'); ?>",
            type: "POST",
            data: 'countryId=' + $('#select-comparison-country').val(),
            success: function(content){
                $('#comparison-options').html(content);
                $('#comparison-options').show();
                $('.comparison-loader').hide();
            },
        });
    }
    else
    {
        var content = '<p style="color:#ff0000; margin:0 0 5px 0;"><?php echo $this->t('index', 'ErrorSelectSupplier');?></p>';
        $('#comparison-options').html(content);
        $('#comparison-options').show();
        $('.comparison-loader').hide();
    }
}
</script>