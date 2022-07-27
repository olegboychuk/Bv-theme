        </main>
        <?php
            $footer_bg = get_field('footer_bg','option');
            $newsletter_title = get_field('newsletter_title','option');
            $newsletter_desc = get_field('newsletter_desc','option');
        ?>
		<footer id="footer">
            <section id="footer-section" class="py-5" style="background: url(<?= $footer_bg['url'] ; ?>)no-repeat scroll center center / cover;">
                <div class="container">
                    <?php if(get_field('newsletter_title','option')): ?> 

                    <div class="row mb-4">
                        <div class="col-md-8 col-12">
                            <h2 class="t-title mb-4">
                                <?= $newsletter_title;?>
                            </h2>
                            <h5 class="wht-txt fnt-light">
                                <?= $newsletter_desc;?>
                            </h5>
                        </div>
                        <div class="col-md-4 col-12">
                            <button class="to-subscribe">
                                <span>להרשמה</span>
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="devider-line mt-5"></div>
                        </div>
                    </div>

                    <?php endif; ?>

                    <div class="row address-row wht-txt fnt-light lg-font">
                        <div class="col-md-8 col-12 fnt-light">
                            <div>
                                <span>
                                    <?php the_field('address','option'); ?>
                                </span>
                            </div>
                            <div>
                                <span>
                                    <a href="tel:<?php the_field('phone','option'); ?>" class="wht-txt txt-dec-none">
                                        <span class="k_contact"><?= _e('טלפון','novo'); ?>: </span><span class="val-contact"><?php the_field('phone','option'); ?></span>
                                    </a>
                                </span> | 
                                <span class="k_contact"><?= _e('פקס','novo'); ?>: </span><span class="val-contact"><?php the_field('fax','option'); ?></span>
                                <span> |
                                    <a href="mailto:<?php the_field('email','option'); ?>" class="wht-txt txt-dec-none">
                                        <span class="k_contact"><?= _e('מייל','novo'); ?>: </span><span class="val-contact"><?php the_field('email','option'); ?></span>
                                    </a>
                                </span> 
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <?php if( have_rows('follow_us','option') ): ?>
                                <ul class="social social-main list-inline mt-4">
                                    <?php while( have_rows('follow_us','option') ): the_row();
                                        $class = get_sub_field('title');
                                        $link = get_sub_field('link');
                                        $fu_aria_label = get_sub_field('fu_aria_label');?>
                                        <li class="<?= $class; ?>">
                                            <a href="<?= esc_url($link); ?>" aria-label="<?= $fu_aria_label; ?>" target="_blank"><?php $class; ?></a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
							<?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <span class="cred">
                                <a class="txt-dec-none sm-font" href="https://www.dropbox.com/s/uazd2ll88r9zr6y/Hastudeo-pdf.pdf?dl=0" target="_blank">עצוב: הסטודאו | </a>
                                <a class="txt-dec-none sm-font" href="https://beaverglobal.com/" target="_blank">פיתוח: ביבר גלובלג</a>
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-start wht-txt sm-font mt-1">
                                <?php the_time(Y);?> &copy;
                            </span>
                        </div>
                    </div>
                </div>

            </section>
        </footer>
    </div>
    <!-- wrapp end -->
	<?php wp_footer(); ?>
</body>
</html>