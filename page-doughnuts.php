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

                <nav class="container">
                    <div class="center">
                        <button data-kategori="alle" class="valgt">Alle</button>
                        <button data-kategori="forretter">Vores Doughnuta</button>
                        <button data-kategori="hovedretter">Vores Café</button>
                        <button data-kategori="desserter">Bestil Online</button>
                        <button data-kategori="drikkevarer">Om Os</button>
                        <button data-kategori="sideorders">FAQ</button>
                    </div>
                </nav>

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
                let filtrer;



                const dbUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/doughnut";

                function start() {
                    console.log("start");
                    const filterKnapper = document.querySelectorAll("nav button");
                    filterKnapper.forEach(knap => knap.addEventListener("click", filtrerKategorier));
                    loadJSON();
                }


                function filtrerKategorier() {
                    filter = this.dataset.kategori;

                    document.querySelector(".valgt").classList.remove(".valgt"); //fjern klassen valgt
                    this.classList.add(".valgt") //tilføy classen valgt til den knapp som er trykket på
                    visMadretter(); //kand funksjonen visMadretter etter det nye filter er sat

                    async function getJson() {
                        const data = await fetch(dbUrl);
                        doughnuts = await data.json();
                        console.log(doughnuts);
                        /*visDoughnuts();*/
                    }

                    function visDoughnuts() {
                        console.log(doughnuts);
                        doughnuts.forEach(doughnut => {
                            /*     if (filter == doughnuts.kategori || filter == "alle") {
                             const klon = skabelon.cloneNode(true);*/
                            const klon = skabelon.cloneNode(true).content;
                            klon.querySelector("h2").textContent = doughnut.title.rendered;
                            klon.querySelector("img").src = doughnut.billede.guid;
                            klon.querySelector(".pris").textContent = doughnut.pris;
                            klon.querySelector(".beskrivelse").textContent = doughnut.beskrivelse;

                            liste.appendChild(klon);

                            /*  }*/

                        })
                    }

                    getJson();

            </script>

        </div><!-- #primary -->

    </div>
    <!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
