<?php
/**
 * The template for displaying front page.
 *

 */

get_header();

$layout = onepress_get_layout();

/**
 * @since 2.0.0
 * @see onepress_display_page_title
 */
do_action( 'onepress_page_before_content' );

?>
<div id="content" class="site-content">
    <?php onepress_breadcrumb(); ?>
    <div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
        <div id="primary" class="content-area_single">


            <main id="main" class="site-main" role="main">
                <article>
                    <img class="pic" src="" alt="">
                    <h2 class="navn"></h2>
                    <p class="pris"></p>
                    <p class="beskrivelse"></p>
                    <p class="ingredienser"></p>
                    <div class="info-container">
                        <button class="tilbageknap" type="tilbageknap">Tilbage</button>
                    </div>

                </article>
            </main><!-- #main -->


            <script>
                let doughnut;


                const dbUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/doughnut/" + <?php echo get_the_ID() ?>;





                async function getJson() {
                    const data = await fetch(dbUrl);
                    doughnut = await data.json();
                    console.log("doughnut", doughnut);

                    visDoughnut();
                }



                function visDoughnut() {
                    console.log(doughnut.billede.guid);

                    document.querySelector("h2").textContent = doughnut.title.rendered;
                    document.querySelector(".pic").src = doughnut.billede.guid;

                    document.querySelector(".pris").textContent = `${"Pris: "}` + doughnut.pris + `${",-"}`;
                    document.querySelector(".beskrivelse").textContent = doughnut.beskrivelse;
                    document.querySelector(".ingredienser").textContent = `${"Ingredienser: "}` + doughnut.ingredienser;

                    document.querySelector("button").addEventListener("click", tilbageTilForside);


                }





                function tilbageTilForside() {
                    history.back();
                }

                getJson();

            </script>
        </div><!-- #primary -->

        <?php if ( $layout != 'no-sidebar' ) { ?>
        <?php get_sidebar(); ?>
        <?php } ?>

    </div>
    <!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
