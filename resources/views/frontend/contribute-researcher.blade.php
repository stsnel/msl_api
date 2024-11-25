@section('title', 'Contribute as a researcher')
<x-layout_main>
<div class="mainContentDiv flex-col">
        <p class="text-4xl p-20">
            How to contribute as a researcher
        </p>

        <div class="flex justify-center items-center flex-col px-4">
            <p>
                Would you like to share Earth scientific laboratory data, or models, from one of the Multi-Scale Laboratories disciplines? Xyz
            </p>
            <p>
                And are you looking to make these discoverable in this catalogue, and in the EPOS data portal?
            </p>
            <p>
                Find out how to do this here.
            </p>
        </div>

        <ul class="timeline p-20">
            <li>
            <div class="timeline-start timeline-box">At which repository will you publish your data?</div>
            <div class="timeline-middle">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5">
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd" />
                </svg>
            </div>
            <hr />
            </li>
            <li>
            <hr />
            <div class="timeline-middle">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5">
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">Check data formatting requirements</div>
            <hr />
            </li>
            <li>
            <hr />
            <div class="timeline-start timeline-box">Enrich your work with MSL vocab</div>
            <div class="timeline-middle">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5">
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd" />
                </svg>
            </div>
            <hr />
            </li>
            <li>
            <hr />
            <div class="timeline-middle">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5">
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">Publish your work</div>
            <hr />
            </li>
        </ul>

        <div class="max-w-screen-md px-4">
            <h2 class="pt-10 pb-4">Step 1: Which repo will you submit your data? 
            </h2>
            <p>Key is that you publish your data at a repository that can generate <a href="https://www.doi.org/">DOI</a>.  
            </p>
            <p>
                EPOS MSL currently provides access to data at these data repositories. The fastest route to make your data discoverable by MSL, 
                is to publish your data at one of these. Would you like to publish elsewhere? Let us know! 
                We can then start working towards including data from your repository too. 
            </p>
    
            <h2 class="pt-10 pb-4">Step 2: prepare your data
            </h2>
            <p>Some repositories have specific requirements or data formats/templates to take into account. 
                Check whether this is relevant for your work → better to know this before you start publishing.</p>
            <p>
                There may also be best practices available for specific research disciplines within MSL → see the list below. 
                These can help you optimize the re-usability of your data by others, and therefore increase the impact of your data publication.
            </p>
            <p>
                Do you know about a best practice relevant for MSL data and models, not listed here? Let us know!
            </p>
    
    
            <div role="tablist" class="tabs tabs-lifted ">
                <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Microscopy" />
                <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6 min-h-28">
                    Structure 2D micrographs using StraboMicro, 
                    and include the exported .smz file in your data publication <a href="Strabospot.org/whatisStrabomicro">Strabospot.org/whatisStrabomicro</a>
                    
                </div>
              
                <input
                  type="radio"
                  name="my_tabs_2"
                  role="tab"
                  class="tab"
                  aria-label="Paleomagnetism"
                  checked="checked" />
                <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6 min-h-28">
                    For paleomagnetic data, publish your data at MagIC, and use their data standards <a href="www2.earthref.org/MagIC">www2.earthref.org/MagIC</a>
                </div>
              
                <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Geochemistry" />
                <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6 min-h-28">
                    Geochemistry: For Geochemistry data, publish your data at EarthChem, and follow their data standards: <a href="https://www.earthchem.org/ecl/submission-guidelines/">https://www.earthchem.org/ecl/submission-guidelines/</a>
                </div>
              </div>
    
    
            <h2 class="pt-10 pb-4">Step 3: While publishing, use MSL keywords    
            </h2>

            <p>Wherever you publish, you make it a lot easier for us to find your data by adding keywords from the Multi-Scale Labs vocabularies (the more the better!). 
                Here you can explore and select which Multi-Scale Labs keywords apply to your research. 
                When you’re done, you can export the keywords you selected, so you know which words to assign when you’re making your next data publication.
            </p>

            ########Placeholder keyword selector###########

            <p>Would you like to embed MSL vocabularies, or the above keyword selector in the data repository you’re affiliated to? You can - it’s all open access and open source. 
                Have a look here on how to approach this (link to: how to contribute as a data repository → and include a few instructions on how to embed the keyword selector there). </p>
            
            <h2 class="pt-10 pb-4">Step 4: publish
            </h2>
            <p>When you publish your data, make sure you do so with an open access license (e.g. <a href="https://creativecommons.org/licenses/by/4.0/deed.en">CC BY 4.0</a> ). 
                Most repositories provide clear guidance on which licenses are useful to provide your data openly, and promote citing. 
            </p>
            <p>Congratulations! Your data is now open access. Your job is done… </p>
            <p>…and our job starts. We strive to find your data, and make it findable for others in EPOS MSL, and the EPOS data portal. We do so by looking for data in these data repositories (see Step 1), 
                that have MSL vocabulary terms (see Step 3) used in the keywords, tags, data descriptions or titles, referring to: </p>
        
            <ul class="list-disc  pt-6 pb-6 pl-10 pr-10">
                <li>The Earth sciences (i.e. from MSL vocabularies: material, geological setting, or (sub)surface utilization) and </li>
                <li> Laboratories (i.e. terms from a.o. “apparatus”, “measured property” or “analyzed feature” sections of MSL 
                    subdomain vocabularies: analogue modelling, geochemistry, paleomagnetism, microscopy and tomography and rock and melt physics), or</li>
                </li>
                <li>A facility name from the Geo-Energy Test Beds. In this case, we know it concerns a GETB data publication.</li>
            </ul>

            <p>Note that we renew this search once or twice per year, meaning that the data you just published may not be harvested by MSL for several months. In doubt? Or do you feel we missed your data publication? Let us know. </p>

        </div>
        
</div>


</x-layout_main>