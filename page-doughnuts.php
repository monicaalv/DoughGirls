<?php
/**
 * The template for displaying page-doughnuts
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
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <h1 id="overskrift">Doughnuts</h1>
                <section id="doughnut-oversigt"></section>


                <template>
                    <article>
                        <img src="" alt="">
                        <div>
                            <h2 class="navn"></h2>
                            <!--<p class="kategori"></p>-->
                            <p class="pris"></p>
                            <p class="beskrivelse"></p>
                        </div>
                    </article>
                </template>
            </main><!-- #main -->

            <script>
                let doughnuts;



                const dbUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/doughnuts?per_page=100";




                async function getJson() {
                    const data = await fetch(dbUrl);
                    doughnuts = await data.json();
                    console.log(doughnuts);
                    /*visDoughnuts();*/
                }

                /* function visDoughnuts() {
                     console.log(doughnuts);
                     doughnuts.forEach(doughnut => {
                         const klon = skabelon.cloneNode(true).content;

                         klon.querySelector("h2").textContent = doughnut.title.rendered;
                         klon.querySelector("img").src = doughnut.billede.guid;
                         klon.querySelector(".pris").textContent = doughnut.pris;
                         klon.querySelector(".beskrivelse").textContent = doughnut.beskrivelse;

                         liste.appendChild(klon);



                     })
                 }*/
                getJson();

            </script>

        </div><!-- #primary -->

    </div>
    <!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
