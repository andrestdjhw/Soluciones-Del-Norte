</main>

    <?php $sdn = sdn_site_data(); ?>
    <div
      id="sdn-footer"
      data-logo-white="<?php echo esc_attr( $sdn['logo_white'] ); ?>"
      data-phone1="<?php echo esc_attr( $sdn['phone1'] ); ?>"
      data-phone2="<?php echo esc_attr( $sdn['phone2'] ); ?>"
      data-email="<?php echo esc_attr( $sdn['email'] ); ?>"
      data-address="<?php echo esc_attr( $sdn['address'] ); ?>"
      data-map-url="<?php echo esc_attr( $sdn['map_url'] ); ?>"
      data-facebook="<?php echo esc_attr( $sdn['facebook'] ); ?>"
      data-instagram="<?php echo esc_attr( $sdn['instagram'] ); ?>"
      data-tiktok="<?php echo esc_attr( $sdn['tiktok'] ); ?>"
      data-agency-url="<?php echo esc_attr( $sdn['agency_url'] ); ?>"
      data-lang="<?php echo esc_attr( $sdn['lang'] ); ?>"
    ></div>

    <?php wp_footer(); ?>
  </body>
</html>