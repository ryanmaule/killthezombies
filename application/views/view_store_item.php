<?php 
$this->load->view('inc_content_header.php');

//var_dump($response);
//check that there are items in the response
if (isset($response['Items']['Item']) ) {

    //loop through each item
    $result = $response['Items']['Item'];
?>


						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<div class="left" style="width:450px">
									<h2>
						            <?php 
						            if (isset($result['ItemAttributes']['Title'])) 
						            {
						                echo $result['ItemAttributes']['Title'];
						            }
						            ?>
            						</h2>
            						</div>
            						<div class="right">
            						<a class="btn" href="/store">RETURN TO STORE</a>
            						</div>
									<div class="cl">&nbsp;</div>
									
								</div>
<?php
    //check that there is a ASIN code - for some reason, some items are not
    //correctly listed. Im sure there is a reason for it, need to check.
    if (isset($result['ASIN'])) {
    
    	//print_r($response['Items']['Item']);

        //store the ASIN code in case we need it
        $asin = $result['ASIN'];

        //check that there is a URL. If not - no need to bother showing
        //this one as we only want linkable items
        if (isset($result['DetailPageURL'])) {
        
            //set up a container for the details - this could be a DIV
            echo '<div style="float:left; width: 225px;">';

            //create the URL link
            echo '<a target="_blank" href="' . $result['DetailPageURL'] .'">';

            //if there is a small image - show it
            if (isset($result['LargeImage']['URL'] )) 
            {
                echo '<img style="margin-left: 10px; height: 300px;" src="'. $result['LargeImage']['URL'] .'">';
            }
            
            echo '</a>';
            echo '<a style="margin: 0 auto;" class="btn" target="_blank" href="' . $result['DetailPageURL'] .'">BUY NOW</a>';
            echo '<br /><br />';
            
            if (isset($result['ItemAttributes']['ListPrice'] )) 
            {
            	echo '<strong>';
            	echo 'List Price: <span style="text-decoration:line-through;">'.$result['ItemAttributes']['ListPrice']['FormattedPrice'];
            	echo ' '.$result['ItemAttributes']['ListPrice']['CurrencyCode'];
            	echo '</span></strong>';
            	echo '<br />';
            }
            
            if (isset($result['Offers']['Offer']['OfferListing']['Price'] )) 
            {
            	echo '<strong>';
            	echo 'Actual Price: <span style="color:green;">'.$result['Offers']['Offer']['OfferListing']['Price']['FormattedPrice'];
            	echo ' '.$result['Offers']['Offer']['OfferListing']['Price']['CurrencyCode'];
            	echo '</span></strong>';
            	echo '<br />';
            }
            
            if (isset($result['Offers']['Offer']['OfferListing']['AmountSaved'] )) 
            {
            	echo '<strong>';
            	echo 'Amount Saved: <span style="color:red;">'.$result['Offers']['Offer']['OfferListing']['AmountSaved']['FormattedPrice'];
            	echo ' '.$result['Offers']['Offer']['OfferListing']['AmountSaved']['CurrencyCode'];
            	echo ' ('.$result['Offers']['Offer']['OfferListing']['PercentageSaved'].'%)';
            	echo '</span></strong>';
            	echo '<br />';
            }
            
            if (isset($result['OfferSummary']['LowestNewPrice'] )) 
            {
            	echo 'Lowest New Price: '.$result['OfferSummary']['LowestNewPrice']['FormattedPrice'];
            	echo ' '.$result['OfferSummary']['LowestNewPrice']['CurrencyCode'];
            	echo '<br />';
            }
            
            if (isset($result['OfferSummary']['LowestUsedPrice'] )) 
            {
            	echo 'Lowest Used Price: '.$result['OfferSummary']['LowestUsedPrice']['FormattedPrice'];
            	echo ' '.$result['OfferSummary']['LowestUsedPrice']['CurrencyCode'];
            	echo '<br />';
            }
            
            if (isset($result['OfferSummary']['LowestCollectiblePrice'] )) 
            {
            	echo 'Lowest Collectible Price: '.$result['OfferSummary']['LowestCollectiblePrice']['FormattedPrice'];
            	echo ' '.$result['OfferSummary']['LowestCollectiblePrice']['CurrencyCode'];
            	echo '<br />';
            }
            
            if (isset($result['OfferSummary']['LowestDigitalPrice'] )) 
            {
            	echo 'Lowest Digital Price: '.$result['OfferSummary']['LowestDigitalPrice']['FormattedPrice'];
            	echo ' '.$result['OfferSummary']['LowestDigitalPrice']['CurrencyCode'];
            	echo '<br />';
            }
            
            echo '</div>';
            
            echo '<div style="float:right; width: 375px;">';
            
            if (isset($result['EditorialReviews']['EditorialReview']))
            {
            	echo $result['EditorialReviews']['EditorialReview']['Content'];
            }

            //close the paragraph
            echo '</div>';
            echo '</div>';
            echo '<div class="section">';
            
        }
        
        if (isset($result['CustomerReviews']['IFrameURL']))
        {
        	//echo '<iframe style="width:900px;" src="'.$result['CustomerReviews']['IFrameURL'].'"></iframe>';
        	echo file_get_contents($result['CustomerReviews']['IFrameURL']);
        }
    }

} else {

    //display that nothing was found - should no results be found
    echo '<p  style="">No Amazon suggestions found</p>';

}
?>
<div class="cl">&nbsp;</div>
<br clear="all" />
							</div>
							<!-- END of section !-->
						</div>
						<!-- END of content !-->
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>