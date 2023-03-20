<div id="home">
    <div class="content-flex home-wrapper">
        <?php if($promo_banner==1) { ?>
            <!-- <div class="registration_ip">
                <div class="row no-gutters">
                    <div class="col-12 align-self-end text-center">
                        <div>
                            <img style="display: inline-block;width: 25px;height: 25px;max-width: none;" src="static/img/smartphones/store-apple.svg">
                            <h1 style="display: inline-block;">iPhone 13.</h1>
                        </div>
                        <div class="registration_ip_head"><div>Ab 1€ und nur hier mit dem Mitarbeiter-Rabatt!</div></div>
                        <div><a href="smartphones" class="btn btn-red">Jetzt bestellen</a></div>
                        <img class="img-responsive desk-i" src="/static/img/smartphones/210918_Login_Promo_iPhone13.png">
                        <img class="img-responsive resp-i" src="/static/img/smartphones/210918_Login_Promo_iPhone13_Resp.png">
                    </div>
                </div>
            </div>      -->
            <?php if($_SESSION['client_id'] != '0') { ?>
                <div class="promo_landing_b">
                    <picture>
                        <source srcset="/static/img/content/promo_010223.webp" type="image/webp">
                        <source srcset="/static/img/content/promo_010223.jpg" type="image/jpeg">
                        <img class="img-responsive desk-i" src="/static/img/content/promo_010223.jpg">
                    </picture>
                    <picture>
                        <source srcset="/static/img/content/promo-resp_010223.webp" type="image/webp">
                        <source srcset="/static/img/content/promo-resp_010223.jpg" type="image/jpeg">
                        <img class="img-responsive resp-i" src="/static/img/content/promo-resp_010223.jpg">
                    </picture>
                    <!-- <div class="i-copy-flag">&copy; Apple</div> -->
                    <!-- <div class="promo-btn-l"><a onclick="selectedExtended(1);" class="btn btn-primary-white btn-auto"><?php // echo 'Zum GigaDeal'; ?></a></div> -->
                    <div class="promo-btn-l"><a onclick="selectedSmartphoneAll(1);">&nbsp;</a></div>
                    <div class="promo-btn-m"><a onclick="selectedSmartphoneAll(1);">&nbsp;</a></div>
                    <div class="promo-btn-r"><a onclick="selectedSmartphoneAll(1);">&nbsp;</a></div>
                </div>
            <?php } else {?>
                <div class="promo_landing_b">
                    <picture>
                        <source srcset="/static/img/content/promo-bp_010223.webp" type="image/webp">
                        <source srcset="/static/img/content/promo-bp_010223.jpg" type="image/jpeg">
                        <img class="img-responsive desk-i" src="/static/img/content/promo-bp_010223.jpg">
                    </picture>
                    <picture>
                        <source srcset="/static/img/content/promo-resp-bp_010223.webp" type="image/webp">
                        <source srcset="/static/img/content/promo-resp-bp_010223.jpg" type="image/jpeg">
                        <img class="img-responsive resp-i" src="/static/img/content/promo-resp-bp_010223.jpg">
                    </picture>
                    <!-- <div class="i-copy-flag">&copy; Apple</div> -->
                    <!-- <div class="promo-btn-l"><a onclick="selectedExtended(1);" class="btn btn-primary-white btn-auto"><?php // echo 'Zum GigaDeal'; ?></a></div> -->
                    <div class="promo-btn-l"><a onclick="selectedSmartphoneAll(1);">&nbsp;</a></div>
                    <div class="promo-btn-m"><a onclick="selectedSmartphoneAll(1);">&nbsp;</a></div>
                    <div class="promo-btn-r"><a onclick="selectedSmartphoneAll(1);">&nbsp;</a></div>
                </div>
            <?php } ?>
        <?php } else if($partner_background==0) { ?>
            <!-- <div class="registration_ip">
                <div class="row no-gutters">
                    <div class="col-12 align-self-end text-center">
                        <div>
                            <img style="display: inline-block;width: 25px;height: 25px;max-width: none;" src="static/img/smartphones/store-apple.svg">
                            <h1 style="display: inline-block;">iPhone 13.</h1>
                        </div>
                        <div class="registration_ip_head"><div>Ab 1€ und nur hier mit dem Mitarbeiter-Rabatt!</div></div>
                        <div><a href="smartphones" class="btn btn-red">Jetzt bestellen</a></div>
                        <img class="img-responsive desk-i" src="/static/img/smartphones/210918_Login_Promo_iPhone13.png">
                        <img class="img-responsive resp-i" src="/static/img/smartphones/210918_Login_Promo_iPhone13_Resp.png">
                    </div>
                </div>
            </div>      -->
            <div class="promo_landing_b">
                <picture>
                    <source srcset="/static/img/content/PROMO-Landing_D.webp" type="image/webp">
                    <source srcset="/static/img/content/PROMO-Landing_D.jpg" type="image/jpeg">
                    <img class="img-responsive desk-i" src="/static/img/content/PROMO-Landing_D.jpg">
                </picture>
                <picture>
                    <source srcset="/static/img/content/PROMO-Landing_D_Resp.webp" type="image/webp">
                    <source srcset="/static/img/content/PROMO-Landing_D_Resp.jpg" type="image/jpeg">
                    <img class="img-responsive resp-i" src="/static/img/content/PROMO-Landing_D_Resp.jpg">
                </picture>
            </div>
        <?php } else { ?>
            <div class="relative-path row no-gutters banner-img-bckg <?php if ($partner_background==0) { ?> banner_default <?php } ?> <?php if($_SESSION['lang']!='de') echo 'en'; ?>" <?php if ($partner_background==1) { ?> style="background-image: url(<?php echo $_SESSION['partner_background_s3']; ?>);" <?php } ?>>
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters flex-h-strech">
                        <div class="col">
                            <div class="d-flex flex-h-strech">
                                <div class="align-self-center">
                                    <hgroup>
                                        <h1><?php echo $multi_lang['Home']['powerCheaper']; ?></h1>
                                        <h3><?php echo $multi_lang['Home']['exclusiveBenefitsEmployee']; ?></h3>
                                    </hgroup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
