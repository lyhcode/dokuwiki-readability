<?php
/**
 * DokuWiki Readibility Template
 * @link   http://lyhdev.com/
 * @author Yan-hong Lin <lyhcode@gmail.com>
 *
 * fork from Starter Template
 * @link   http://dokuwiki.org/template:starter
 * @author Anika Henke <anika@selfthinker.org>
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && $_SERVER['REMOTE_USER'] );
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php tpl_pagetitle() ?> - <?php echo strip_tags($conf['title']) ?></title>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" media="screen" href="<?php echo DOKU_TPL.'css/reset.css'?>">
	<link href="http://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css" />
	<?php tpl_metaheaders() ?>
    <link rel="shortcut icon" href="<?php echo _tpl_getFavicon() ?>" />
    <?php @include(dirname(__FILE__).'/meta.html') /* include hook */ ?>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/pepper-grinder/jquery-ui.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
    <!--<link rel="stylesheet" media="screen" href="<?php echo DOKU_TPL.'css/less.css'?>">-->
    <link rel="stylesheet" media="screen" href="<?php echo DOKU_TPL.'css/readability.css'?>">
	<script type="text/javascript" src="<?php echo DOKU_TPL.'readability.js'?>"></script>
</head>

<body>
    <!--[if IE 6 ]><div id="IE6"><![endif]--><!--[if IE 7 ]><div id="IE7"><![endif]--><!--[if IE 8 ]><div id="IE8"><![endif]-->
    <?php @include(dirname(__FILE__).'/topheader.html') /* include hook */ ?>

	<!--paper-->
	<div id="paper"><div id="dokuwiki__site"><div class="dokuwiki site mode_<?php echo $ACT ?>">
        <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>

        <!-- ********** HEADER ********** -->
        <div id="dokuwiki__header"><div class="pad">

            <div class="headings">
                <h1><?php tpl_link(wl(),$conf['title'],'id="dokuwiki__top" accesskey="h" title="[H]"') ?></h1>
                <?php if (tpl_getConf('tagline')): ?>
                    <p class="claim"><?php echo tpl_getConf('tagline') ?></p>
                <?php endif ?>

                <ul class="a11y">
                    <li><a href="#dokuwiki__content"><?php echo tpl_getLang('skip_to_content') ?></a></li>
                </ul>
                <div class="clearer"></div>
            </div>

            <div class="tools">
                <!-- USER TOOLS -->
                <?php if ($conf['useacl'] && $showTools): ?>
                    <div id="dokuwiki__usertools">
                        <h3 class="a11y"><?php echo tpl_getLang('user_tools') ?></h3>
                        <ul>
                            <?php /* the optional second parameter of tpl_action() switches between a link and a button,
                                     e.g. a button inside a <li> would be: tpl_action('edit',0,'li') */
                                if ($_SERVER['REMOTE_USER']) {
                                    echo '<li class="user">';
                                    tpl_userinfo(); /* 'Logged in as ...' */
                                    echo '</li>';
                                }
                                tpl_action('admin', 1, 'li');
                                if (tpl_getConf('userNS')) {
                                    _tpl_userpage(tpl_getConf('userNS'),1,'li');
                                }
                                tpl_action('profile', 1, 'li');
                                tpl_action('login', 1, 'li');
                            ?>
                        </ul>
                    </div>
                <?php endif ?>

                <!-- SITE TOOLS -->
                <div id="dokuwiki__sitetools">
                    <h3 class="a11y"><?php echo tpl_getLang('site_tools') ?></h3>
                    <?php tpl_searchform() ?>
                    <ul>
                        <?php
                            tpl_action('recent', 1, 'li');
                            tpl_action('index', 1, 'li');
                        ?>
                    </ul>
                </div>

            </div>
            <div class="clearer"></div>

            <!-- BREADCRUMBS -->
            <?php if($conf['breadcrumbs']){ ?>
              <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
            <?php } ?>
            <?php if($conf['youarehere']){ ?>
              <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
            <?php } ?>

            <?php @include(dirname(__FILE__).'/header.html') /* include hook */ ?>
            <div class="clearer"></div>
            <hr class="a11y" />
        </div></div><!-- /header -->

		<div class="wrapper">

			<div id="dokuwiki__toc" title="Table of Contents">
				<?php tpl_toc(); ?>
			</div>

            <!-- ********** CONTENT ********** -->
            <div id="dokuwiki__content"><div class="pad">
                <?php tpl_flush() /* flush the output buffer */ ?>
                <?php @include(dirname(__FILE__).'/pageheader.html') /* include hook */ ?>

                <div class="page">
                    <!-- wikipage start -->
                    <?php tpl_content(false) /* the main content */ ?>
                    <!-- wikipage stop -->
                    <div class="clearer"></div>
                </div>

                <?php tpl_flush() ?>
                <?php @include(dirname(__FILE__).'/pagefooter.html') /* include hook */ ?>
            </div></div><!-- /content -->

            <div class="clearer"></div>
            <hr class="a11y" />

            <!-- PAGE ACTIONS -->
            <?php if ($showTools): ?>
                <div id="dokuwiki__pagetools">
                    <h3 class="a11y"><?php echo tpl_getLang('page_tools') ?></h3>
                    <ul>
                        <?php
                            tpl_action('edit', 1, 'li');
                            if (tpl_getConf('discussionNS')) {
                                _tpl_discussion(tpl_getConf('discussionNS'),1,'li',tpl_getConf('discussNSreverse'));
                            }
                            tpl_action('history', 1, 'li');
                            tpl_action('backlink', 1, 'li');
                            tpl_action('subscribe', 1, 'li');
                            tpl_action('revert', 1, 'li');
                            tpl_action('top', 1, 'li');
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div><!-- /wrapper -->

        <!-- ********** FOOTER ********** -->
        <div id="dokuwiki__footer"><div class="pad">
            <div class="doc"><?php tpl_pageinfo() /* 'Last modified' etc */ ?></div>
            <?php tpl_license('button') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
        </div></div><!-- /footer -->

    </div></div></div><!-- /site -->

	<!-- ********** ASIDE ********** -->
	<div id="dokuwiki__aside" title="Index">
		<?php tpl_include_page(tpl_getConf('sidebarID')) /* includes the given wiki page */ ?>
	</div><!-- /aside -->

	<div id="dokuwiki__sidebar">
		<div id="toolbar">
			<ul>
				<li><a id="button-home" href="<?php echo DOKU_URL; ?>"><img src="<?php echo DOKU_TPL.'images/icon_home.png' ?>" alt="home" border="0" /></a></li>
				<li><a id="button-menu" href="#"><img src="<?php echo DOKU_TPL.'images/icon_menu.png' ?>" alt="menu" border="0" /></a></li>
				<li><a id="button-toc" href="#"><img src="<?php echo DOKU_TPL.'images/icon_toc.png' ?>" alt="toc" border="0" /></a></li>
				<li><a id="button-share" href="#"><img src="<?php echo DOKU_TPL.'images/icon_share.png' ?>" alt="share" border="0" /></a></li>
				<li><a id="button-comment" href="#"><img src="<?php echo DOKU_TPL.'images/icon_comment.png' ?>" alt="comment" border="0" /></a></li>
			</ul>
		</div>	
	</div>
    
	<?php @include(dirname(__FILE__).'/footer.html') /* include hook */ ?>
    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <!--[if ( IE 6 | IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
