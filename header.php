<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="<?php echo esc_url( sdn_canonical_url() ); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> data-sdn-lock="false">
    <?php wp_body_open(); ?>

    <?php
    $sdn = sdn_site_data();
    ?>
    <div
      id="sdn-navbar"
      data-home="<?php echo esc_attr( $sdn['home'] ); ?>"
      data-logo="<?php echo esc_attr( $sdn['logo'] ); ?>"
      data-phone1="<?php echo esc_attr( $sdn['phone1'] ); ?>"
      data-phone2="<?php echo esc_attr( $sdn['phone2'] ); ?>"
      data-email="<?php echo esc_attr( $sdn['email'] ); ?>"
      data-address="<?php echo esc_attr( $sdn['address'] ); ?>"
      data-address-short="<?php echo esc_attr( $sdn['address_short'] ); ?>"
      data-map-url="<?php echo esc_attr( $sdn['map_url'] ); ?>"
      data-facebook="<?php echo esc_attr( $sdn['facebook'] ); ?>"
      data-instagram="<?php echo esc_attr( $sdn['instagram'] ); ?>"
      data-tiktok="<?php echo esc_attr( $sdn['tiktok'] ); ?>"
      data-lang="<?php echo esc_attr( $sdn['lang'] ); ?>"
    ></div>

    <main id="main">