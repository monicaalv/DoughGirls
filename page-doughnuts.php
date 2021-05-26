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
        <!-- <div id="primary" class="content-area">-->

        <!--  <h1 id="overskrift">Doughnuts</h1>
  <section id="doughnut-oversigt"></section>-->


        <template>
            <article>
                <img src="" alt="">

                <h2 class="navn"></h2>
                <!--<p class="kategori"></p>-->
                <p class="pris"></p>
                <p class="beskrivelse"></p>

            </article>
        </template>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <!-- ved ikke hvad dette er-->

                <section id="primary" class="content-area"></section>
                <nav id="filtrering"><button data-doughnut="alle" class="filter valgt">Alle doughnuts</button></nav>

                <section id="doughnutcontainer"></section>

            </main><!-- #main -->
        </div><!-- #primary -->

        <script>
            let doughnuts;
            let categories;
            let filterDoughnuts = "alle";



            const dbUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/doughnut";

            const catUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/categories"




            async function getJson() {
                const data = await fetch(dbUrl);
                const catdata = await fetch(catUrl);
                doughnuts = await data.json();
                categories = await catdata.json();

                /*  console.log(doughnuts);*/

                visDoughnuts();
                opretKnapper();
            }

            function opretKnapper() {
                categories.forEach(cat => {
                    document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
                })

                addEventListenerToButtons();
            }

            function addEventListenerToButtons() {
                document.querySelectorAll("#filtrering button").forEach(elm => {
                    elm.addEventListener("click", filtrering);
                })


            }

            function filtrering() {

                document.querySelector(".valgt").classList.remove("valgt");

                this.classList.add("valgt");

                filterDoughnut = this.dataset.doughnuts; /*med eller uden s*/
                console.log(filterDoughnuts);

                visDoughnuts();



            }


            function visDoughnuts() {
                let temp = document.querySelector("template");
                let container = document.querySelector("#doughnutcontainer")
                container.innerHTML = "";
                console.log(doughnuts);

                doughnuts.forEach(doughnut => {
                    if (filterDoughnuts == "alle" || doughnut.categories.includes(parseInt(filterDoughnut))) {

                        let klon = temp.cloneNode(true).content;

                        klon.querySelector("h2").textContent = doughnut.title.rendered;
                        klon.querySelector("img").src = doughnut.billede.guid;
                        klon.querySelector(".pris").textContent = doughnut.pris;
                        klon.querySelector(".beskrivelse").textContent = doughnut.beskrivelse;

                        klon.querySelector("article").addEventListener("click", () => {
                            location.href = doughnut.link;

                        })
                        container.appendChild(klon);

                    }

                })
            }

            getJson();

        </script>



    </div>
    <!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
