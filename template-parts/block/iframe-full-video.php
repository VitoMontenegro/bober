<?php /*
<section class="section iframe-full-video__section">
    <div class="container">
        <div class="iframe-full-video">

            <?php if(get_field('iframe-full-video_text-top')){?>
            <div class="iframe-full-video__text-top">
                <i class="icon">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.74517 1.50719C6.74517 0.950936 7.19605 0.5 7.75222 0.5H12.248C12.8042 0.5 13.255 0.950936 13.255 1.50719C13.255 2.06345 12.8042 2.51439 12.248 2.51439H7.75222C7.19605 2.51439 6.74517 2.06345 6.74517 1.50719ZM10.0001 5.08376C6.34321 5.08376 3.36436 8.0759 3.36436 11.7847C3.36436 15.4935 6.34321 18.4856 10.0001 18.4856C13.657 18.4856 16.6359 15.4935 16.6359 11.7847C16.6359 8.0759 13.657 5.08376 10.0001 5.08376ZM1.35026 11.7847C1.35026 6.97931 5.215 3.06937 10.0001 3.06937C14.7852 3.06937 18.65 6.97931 18.65 11.7847C18.65 16.5901 14.7852 20.5 10.0001 20.5C5.215 20.5 1.35026 16.5901 1.35026 11.7847ZM10.0001 7.55118C10.5563 7.55118 11.0072 8.00211 11.0072 8.55837V11.5949C11.0072 12.1512 10.5563 12.6021 10.0001 12.6021C9.44393 12.6021 8.99306 12.1512 8.99306 11.5949V8.55837C8.99306 8.00211 9.44393 7.55118 10.0001 7.55118Z" fill="white" />
                    </svg>
                </i>
                <div><?php the_field('iframe-full-video_text-top');?></div>
            </div>
            <?php } ?>

            <?php if(get_field('iframe-full-video_text-bottom') || get_field('iframe-full-video_link-bottom')){?>

                <?php if (get_field('iframe-full-video_link-bottom')){?>
                    <a href="<?php the_field('iframe-full-video_link-bottom');?>" class="iframe-full-video__text-bottom">
                        <?php if(get_field('iframe-full-video_text-bottom')){?>
                            <span><?php the_field('iframe-full-video_text-bottom');?></span>
                        <?php } ?>
                        <i class="icon">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.71344C5.6996 2.71344 2.21344 6.1996 2.21344 10.5C2.21344 14.8004 5.6996 18.2866 10 18.2866C14.3004 18.2866 17.7866 14.8004 17.7866 10.5C17.7866 6.1996 14.3004 2.71344 10 2.71344ZM0 10.5C-2.26168e-07 4.97715 4.47715 0.5 10 0.5C15.5228 0.5 20 4.97715 20 10.5C20 16.0228 15.5228 20.5 10 20.5C4.47715 20.5 2.26168e-07 16.0228 0 10.5ZM8.17928 5.52232C8.64884 5.13103 9.34669 5.19447 9.73799 5.66402L13.0133 9.59436C13.3553 10.0048 13.3553 10.6009 13.0133 11.0114L9.73799 14.9417C9.34669 15.4113 8.64884 15.4747 8.17928 15.0834C7.70973 14.6921 7.64628 13.9943 8.03758 13.5247L10.7224 10.3029L8.03758 7.08103C7.64628 6.61148 7.70973 5.91362 8.17928 5.52232Z" fill="white" />
                            </svg>
                        </i>
                    </a>
                    <?php } else { ?>
                    <div class="iframe-full-video__text-bottom">
                        <?php if(get_field('iframe-full-video_text-bottom')){?>
                            <span><?php the_field('iframe-full-video_text-bottom');?></span>
                        <?php } ?>
                        <i class="icon">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.71344C5.6996 2.71344 2.21344 6.1996 2.21344 10.5C2.21344 14.8004 5.6996 18.2866 10 18.2866C14.3004 18.2866 17.7866 14.8004 17.7866 10.5C17.7866 6.1996 14.3004 2.71344 10 2.71344ZM0 10.5C-2.26168e-07 4.97715 4.47715 0.5 10 0.5C15.5228 0.5 20 4.97715 20 10.5C20 16.0228 15.5228 20.5 10 20.5C4.47715 20.5 2.26168e-07 16.0228 0 10.5ZM8.17928 5.52232C8.64884 5.13103 9.34669 5.19447 9.73799 5.66402L13.0133 9.59436C13.3553 10.0048 13.3553 10.6009 13.0133 11.0114L9.73799 14.9417C9.34669 15.4113 8.64884 15.4747 8.17928 15.0834C7.70973 14.6921 7.64628 13.9943 8.03758 13.5247L10.7224 10.3029L8.03758 7.08103C7.64628 6.61148 7.70973 5.91362 8.17928 5.52232Z" fill="white" />
                            </svg>
                        </i>
                    </div>
                    <?php } ?>
            <?php } ?>

            <div class="iframe-full-video__wrap youtube-video__wrap">
                <img src="//img.youtube.com/vi/<?php the_field('iframe-full-video_iframe-code');?>/maxresdefault.jpg" data-idYoutube="<?php the_field('iframe-full-video_iframe-code');?>" class="iframe-full-video__wrap__preview youtube-video__preview">
                <div class="youtube-video__iframe-block" id="youtube-video__iframe-block__id-<?php echo $GLOBALS['youtube_id'];?>"></div><?php $GLOBALS['youtube_id']++;?>
                <button class="iframe-full-video__play-button youtube-video__hidden-btn-play">
                    <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="110" height="110" rx="55" fill="white" />
                        <path d="M43 67.5032V42.4968C43 39.7778 43 38.4183 43.5588 37.6543C44.0458 36.9884 44.7919 36.5694 45.605 36.5051C46.5379 36.4314 47.6676 37.1564 49.927 38.6064L69.409 51.1096C71.4214 52.4011 72.4276 53.0469 72.7734 53.8719C73.0755 54.5925 73.0755 55.4075 72.7734 56.1281C72.4276 56.9531 71.4214 57.5989 69.409 58.8904L49.927 71.3936C47.6676 72.8436 46.5379 73.5686 45.605 73.4949C44.7919 73.4306 44.0458 73.0116 43.5588 72.3457C43 71.5817 43 70.2222 43 67.5032Z" fill="#EB6025" />
                    </svg>
                </button>

            </div>
        </div>
    </div>
</section>
*/?>