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
        <div id="primary" class="content-area donut">

            <h1 id="overskrift">Vores doughnuts</h1>
            <!-- <section id="doughnut-oversigt"></section>-->


            <template>
                <article>

                    <img class="billede" src="" alt="">
                    <h2 class="navn"></h2>
                    <img clas="ikon" src="" alt="ikon">
                    <p class="pris"></p>
                    <div class="info-container">
                        <button class="infoknap" type="infoknap">Læs mere</button>
                    </div>


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
                /*  --definerer globale variabler--*/
                let doughnuts;
                let categories;
                let filterDoughnuts = "alle";


                /*--definerer en konstant, og henter data fra url--*/
                const dbUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/doughnut?per_page=100";

                const catUrl = "http://monicaamundsen.com/kea/10_eksamen/doughgirls/wp-json/wp/v2/categories"



                /* --fetcher data fra json--*/
                async function getJson() {
                    const data = await fetch(dbUrl);
                    const catdata = await fetch(catUrl);
                    doughnuts = await data.json();
                    categories = await catdata.json();

                    /*  console.log(doughnuts);*/

                    visDoughnuts();
                    opretKnapper();
                }

                /* --filtreringsknapperne bliver defineret med id og navn--*/
                function opretKnapper() {
                    categories.forEach(cat => {
                        document.querySelector("#filtrering").innerHTML += `<button class="filter" data-doughnut="${cat.id}">${cat.name}</button>`
                    })

                    addEventListenerToButtons();
                }

                /*   --peger på knapperne i html, for hvert element lytter til click--*/
                function addEventListenerToButtons() {
                    document.querySelectorAll("#filtrering button").forEach(elm => {
                        elm.addEventListener("click", filtrering);
                    })


                }

                /* --filtrerer doughnuts--*/
                function filtrering() {

                    document.querySelector(".valgt").classList.remove("valgt");

                    this.classList.add("valgt");

                    filterDoughnuts = this.dataset.doughnut;
                    console.log("filterDoughnuts", filterDoughnuts);

                    visDoughnuts();



                }

                /* --definerer to lokale variabler til template og section--*/
                function visDoughnuts() {
                    let temp = document.querySelector("template");
                    let container = document.querySelector("#doughnutcontainer");

                    /* --tømmer section for indhold--*/
                    container.innerHTML = "";
                    console.log("doughnuts", doughnuts);

                    /* -- Laver if sætning til kategorier til doughnuts, filterere imellem doughnuts--*/
                    doughnuts.forEach(doughnut => {
                        if (filterDoughnuts == "alle" || doughnut.categories.includes(parseInt(filterDoughnuts))) {

                            /*-- Kloner templaten*/
                            let klon = temp.cloneNode(true).content;

                            /*--kloner indhold med id--*/
                            klon.querySelector("h2").textContent = doughnut.title.rendered;
                            klon.querySelector(".billede").src = doughnut.billede.guid;
                            klon.querySelector(".ikon").src = doughnut.ikon.ikon;

                            klon.querySelector(".pris").textContent = `${"Pris: "}` + doughnut.pris + `${",-"}`;

                            /*--lytter efter klik på artikel--*/
                            klon.querySelector("article").addEventListener("click", () => {
                                location.href = doughnut.link;

                            })
                            /*--Kloner indhold til DOM--*/
                            container.appendChild(klon);

                        }

                    })
                }

                getJson();

            </script>



        </div>
    </div>
    <!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
