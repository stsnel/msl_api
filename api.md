# EPOS MSL API
The EPOS MSL API offers access to data available within our CKAN portal. This document describes the API per available endpoint.
A Postman collection file is available at (link to postman collection)

todo
+ mention base url
+ add postman link
+ add all endpoints
+ add anchor links
+ spellingcheck

## Available resources
The API offers 5 domain specific endpoints and 1 endpoint offering access to all data-publications available. All data is open accesable, no authorization is required.
+ rock_physics
+ analogue
+ paleo
+ microscopy
+ geochemistry
+ all

# /rock_physics
This endpoint gives access to all data-publications available that are marked as belonging to the rock physics (sub)domain. 

## Search all rock physics data-publications [GET]
+ Parameters

    + rows (number, optional) - The number of results to return.
        + Default: `10`
    + start (number, optional) - The number to start results from. 
        + Default: `0`
    + query (text, optional) - Words to search for. 
        + Default: ``
    + authorName (text, optional) - Author names to search for. 
        + Default: ``
    + labName (text, optional) - Lab names to search for. 
        + Default: ``
    + title (text, optional) - Title to search for. 
        + Default: ``
    + tags (text, optional) - Tags to search for. 
        + Default: ``

        
+ Response 200 (application/json)

<details>
  <summary>view response</summary>
  
```json
  {
    "success": true,
    "message": "",
    "result": {
        "count": 83,
        "resultCount": 10,
        "results": [
            {
                "title": "Electrical measurements of explosive volcanic eruptions from Stromboli Volcano, Italy",
                "name": "505abe9ae6c4c27cc7a5f33b67e29fff",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/505abe9ae6c4c27cc7a5f33b67e29fff",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2022.005",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2022.005",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "rock and melt physics",
                    "analogue modelling of geologic processes"
                ],
                "description": "These data files contain short periods of electrical data recorded at Stromboli volcano, Italy, in 2019 and 2020 using a prototype version of the Biral Thunderstorm Detector BTD-200. This sensor consists of two antennas, the primary and secondary antenna, which detect slow variations in the electrostatic field resulting from charge neutralisation due to electrical discharges.\nThe sensor recorded at three different locations: BTD1 (38.79551°N, 15.21518°E), BTD2 (38.80738°N, 15.21355°E) and BTD3 (38.79668°N, 15.21622°E).\n\n Electrical data of the following explosions is provided (each in a separate data file):\n- Three Strombolian explosions on 12 June 2019 at 12:46:53, 12:49:27 and 12:56:10 UTC, respectively.\n- A major explosion on 25 June 2019 at 23:03:08 UTC.\n- A major explosion on 19 July 2020 at 03:00:42 UTC.\n- A major explosion on 16 November 2020 at 09:17:45 UTC.\n- A paroxysmal event at 3 July 2019 at 14:45:43 UTC.\n\nEach filename indicates the location of the BTD, the starting date and time of the file in UTC, and a short description of the three data columns inside the file (unixtime, primary, secondary). The first column provides the Unix timestamp of each data point, which is the time in seconds since 01/01/1970. All time is provided in UTC.  The second column provides the measured voltage [V] recorded by the primary antenna. The third column provides the measured voltage [V] recorded by the secondary antenna.",
                "publicationDate": "",
                "citation": "Vossen, C., &amp; Cimarelli, C. (2022). <i>Electrical measurements of explosive volcanic eruptions from Stromboli Volcano, Italy</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2022.005",
                "creators": [
                    {
                        "authorName": "Vossen, Caron",
                        "authorIdentifier": "http://orcid.org/0000-0001-7090-1857",
                        "authorAffiliation": "Ludwig-Maximilians-Universität München, Munich, Germany"
                    },
                    {
                        "authorName": "Cimarelli, Corrado",
                        "authorIdentifier": "http://orcid.org/0000-0002-5707-5930",
                        "authorAffiliation": "Ludwig-Maximilians-Universität München, Munich, Germany"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "DOI of paper when available",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "",
                        "referenceType": "IsSupplementTo"
                    }
                ],
                "laboratories": [],
                "materials": [],
                "spatial": [
                    {
                        "eLong": "15.2152",
                        "nLat": "38.7955",
                        "sLate": "38.7955",
                        "wLong": "15.2152"
                    },
                    {
                        "eLong": "15.2135",
                        "nLat": "38.8074",
                        "sLate": "38.8074",
                        "wLong": "15.2135"
                    },
                    {
                        "eLong": "15.2162",
                        "nLat": "38.7967",
                        "sLate": "38.7967",
                        "wLong": "15.2162"
                    }
                ],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": []
            },
            {
                "title": "Ring-shear test data of wheat flour used for analogue experiments in the laboratory of the Institute of Geophysics of the Czech Academy of Science, Prague",
                "name": "910c9d3a3321ec6e83f62c84bcde7aa4",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/910c9d3a3321ec6e83f62c84bcde7aa4",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2022.016",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2022.016",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "analogue modelling of geologic processes",
                    "rock and melt physics"
                ],
                "description": "This dataset provides friction data from ring-shear tests (RST) for wheat flour used as a fine-grained, cohesive analogue material for simulating brittle upper crustal rocks in the analogue labor-atory of the Institute of Geophysics of the Czech Academy of Science (IGCAS). It is characterized by means of internal friction coefficients µ and cohesion C.\n According to our analysis the materials show a Mohr-Coulomb behaviour characterized by a linear failure envelope. Peak friction coefficients µP of the tested material is ~0.72, dynamic friction coeffi-cients µD is ~0.67 and reactivation friction coefficients µR is ~0.70. Cohesions of the material range between 27 and 50 Pa. The material shows a minor rate-weakening of ~1.5% per ten-fold change in shear velocity v and a stick-slip behaviour at low shear velocities.\n ",
                "publicationDate": "",
                "citation": "Warsitzka, M., Zavada, P., &amp; Rosenau, M. (2022). <i>Ring-shear test data of wheat flour used for analogue experiments in the laboratory of the Institute of Geophysics of the Czech Academy of Science, Prague</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2022.016",
                "creators": [
                    {
                        "authorName": "Warsitzka, Michael",
                        "authorIdentifier": "http://orcid.org/0000-0003-1774-5888",
                        "authorAffiliation": "Institute of Geophysics, Czech Academy of Sciences, Prague, Czech Republic"
                    },
                    {
                        "authorName": "Zavada, Prokop",
                        "authorIdentifier": "http://orcid.org/0000-0003-1702-3770",
                        "authorAffiliation": "Institute of Geophysics, Czech Academy of Sciences, Prague, Czech Republic"
                    },
                    {
                        "authorName": "Rosenau, Matthias",
                        "authorIdentifier": "http://orcid.org/0000-0003-1134-5381",
                        "authorAffiliation": "GFZ German Research Centre for Geosciences, Potsdam, Germany"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2016.01.017",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Klinkmüller, M., Schreurs, G., Rosenau, M., & Kemnitz, H. (2016). Properties of granular analogue model materials: A community wide survey. Tectonophysics, 684, 23–38. https://doi.org/10.1016/j.tecto.2016.01.017\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1002/2016JB012915",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Ritter, M. C., Leever, K., Rosenau, M., & Oncken, O. (2016). Scaling the sandbox-Mechanical (dis) similarities of granular materials and brittle rock. Journal of Geophysical Research: Solid Earth, 121(9), 6863–6879. Portico. https://doi.org/10.1002/2016jb012915\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.jsg.2015.03.008",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Santimano, T., Rosenau, M., & Oncken, O. (2015). Intrinsic versus extrinsic variability of analogue sand-box experiments – Insights from statistical analysis of repeated accretionary sand wedge experiments. Journal of Structural Geology, 75, 80–100. https://doi.org/10.1016/j.jsg.2015.03.008\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1002/ceat.200303112",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Schulze, D. (2003). Time- and Velocity-Dependent Properties of Powders Effecting Slip-Stick Oscillations. Chemical Engineering &amp; Technology, 26(10), 1047–1051. https://doi.org/10.1002/ceat.200303112\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1007/978-3-540-73768-1",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Powders and Bulk Solids. (2007). https://doi.org/10.1007/978-3-540-73768-1\n",
                        "referenceType": "Cites"
                    }
                ],
                "laboratories": [
                    "Institute of Geophysics of the Czech Academy of Sciences, Czech Republic",
                    "GFZ German Research Centre for Geosciences, Potsdam, Germany"
                ],
                "materials": [
                    "quartz sand"
                ],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": [
                    "cohesion",
                    "friction coefficient"
                ]
            },
            {
                "title": "VOLcanic conduit processes and their effect on PROjectile eXit dYnamics (VOLPROXY)",
                "name": "b201db40f1d5d41ea639518192657d75",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/b201db40f1d5d41ea639518192657d75",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2022.004",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2022.004",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "rock and melt physics"
                ],
                "description": "Volcanic projectiles are centimeter- to meter-sized clasts – both solid-to-molten rock fragments or lithic eroded from conduits – ejected during explosive volcanic eruptions that follow ballistic trajectories. Despite being ranked as less dangerous than large-scale processes such as pyroclastic density currents (hot avalanches of gas and pyroclasts), volcanic projectiles still represent a constant threat to life and properties in the vicinity of volcanic vents, and frequently cause fatal accidents on volcanoes. Mapping of their size, shape, and location in volcanic deposits can be combined to model possible trajectories of projectiles from the vent to their final position, and to estimate crucial source parameters of the driving eruption, such as ejection velocity and pressure differential at the vent. Moreover, size and spatial distributions of volcanic projectiles from past eruptions, coupled with ballistic modelling of their trajectory, are crucial to forecast their possible impact in future eruptions. The reliability of such models strongly depends on i) the appropriate physical functions and input parameters and ii) observational validations. In this study, we aimed to unravel intra-conduit processes that strongly control the dynamic of volcanic projectiles by combining numerical modelling and novel experimentally-determined source parameter. In particular, the multiphase ASHEE model (Cerminara 2016; Cerminara et al. 2016) suited for testing post-fragmentation conduit dynamics based on a robust shock tube experimental dataset. By exploding mixtures of pumice and dense lithic particles within a specially designed transparent autoclave, and by using a raft of pressure sensors, ultra-high-speed cameras and pre-sieved natural particles, we observed and quantified: i) kinematic data of the particles and of the gas front along the shock tube and outside, ii) pressure decay at 1GHz resolution. By feeding the ASHEE model with these datasets, and using initial and boundary conditions similar to that of the experiment, we defined domains composed by a pressurized shock tube and the outside chamber at ambient conditions, and tested particles particle motion according to a Lagrangian approach, as well as gas flow with a Eulerian approach (a 3D finite-volume numerical solver, compressible). The comparison between data and model yields estimate of the particle kinematic inside the tube, the pressure evolution at the top and the bottom of the tube, and the eruption source parameters at the tube exit.",
                "publicationDate": "",
                "citation": "Montanaro, C., &amp; Cerminara, M. (2022). <i>VOLcanic conduit processes and their effect on PROjectile eXit dYnamics (VOLPROXY)</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2022.004",
                "creators": [
                    {
                        "authorName": "Montanaro, Cristian",
                        "authorIdentifier": "http://orcid.org/0000-0002-7896-3419",
                        "authorAffiliation": "Ludwig-Maximilians-University Munich, Munich, Germany"
                    },
                    {
                        "authorName": "Cerminara, Matteo",
                        "authorIdentifier": "http://orcid.org/0000-0001-5155-5872",
                        "authorAffiliation": "INGV Pisa: Istituto Nazionale di Geofisica e Vulcanologia, Pisa, Italy"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1016/S0377-0273(00)00149-9",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Alidibirov, M., & Dingwell, D. B. (2000). Three fragmentation mechanisms for highly viscous magma under rapid decompression. Journal of Volcanology and Geothermal Research, 100(1–4), 413–421. https://doi.org/10.1016/s0377-0273(00)00149-9\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1038/s41598-018-22539-8",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Aravena, Á., Cioni, R., de’Michieli Vitturi, M., & Neri, A. (2018). Conduit stability effects on intensity and steadiness of explosive eruptions. Scientific Reports, 8(1). https://doi.org/10.1038/s41598-018-22539-8\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/S0012-821X(02)00952-4",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Cagnoli, B., Barmin, A., Melnik, O., & Sparks, R. S. J. (2002). Depressurization of fine powders in a shock tube and dynamics of fragmented magma in volcanic conduits. Earth and Planetary Science Letters, 204(1–2), 101–113. https://doi.org/10.1016/s0012-821x(02)00952-4\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.jvolgeores.2016.06.018",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Cerminara, M., Esposti Ongaro, T., & Neri, A. (2016). Large Eddy Simulation of gas–particle kinematic decoupling and turbulent entrainment in volcanic plumes. Journal of Volcanology and Geothermal Research, 326, 143–171. https://doi.org/10.1016/j.jvolgeores.2016.06.018\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1080/00288306.2021.1895231",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Cronin, S. J., Zernack, A. V., Ukstins, I. A., Turner, M. B., Torres-Orozco, R., Stewart, R. B., Smith, I. E. M., Procter, J. N., Price, R., Platz, T., Petterson, M., Neall, V. E., McDonald, G. S., Lerner, G. A., Damaschcke, M., & Bebbington, M. S. (2021). The geological history and hazards of a long-lived stratovolcano, Mt. Taranaki, New Zealand. New Zealand Journal of Geology and Geophysics, 1–23. https://doi.org/10.1080/00288306.2021.1895231\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1098/rspa.2009.0382",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Fowler, A. C., Scheu, B., Lee, W. T., & McGuinness, M. J. (2009). A theoretical model of the explosive fragmentation of vesicular magma. Proceedings of the Royal Society A: Mathematical, Physical and Engineering Sciences, 466(2115), 731–752. https://doi.org/10.1098/rspa.2009.0382\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1098/rspa.2015.0843",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Fowler, A. C., & Scheu, B. (2016). A theoretical explanation of grain size distributions in explosive rock fragmentation. Proceedings of the Royal Society A: Mathematical, Physical and Engineering Sciences, 472(2190), 20150843. https://doi.org/10.1098/rspa.2015.0843\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.jvolgeores.2005.08.006",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Kueppers, U., Scheu, B., Spieler, O., & Dingwell, D. B. (2006). Fragmentation efficiency of explosive volcanic eruptions: A study of experimentally generated pyroclasts. Journal of Volcanology and Geothermal Research, 153(1–2), 125–135. https://doi.org/10.1016/j.jvolgeores.2005.08.006\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1029/93JB02972",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Papale, P., & Dobran, F. (1994). Magma flow along the volcanic conduit during the Plinian and pyroclastic flow phases of the May 18, 1980, Mount St. Helens eruption. Journal of Geophysical Research: Solid Earth, 99(B3), 4355–4373. Portico. https://doi.org/10.1029/93jb02972\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.epsl.2019.02.028",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Paredes-Mariño, J., Scheu, B., Montanaro, C., Arciniega-Ceballos, A., Dingwell, D. B., & Perugini, D. (2019). Volcanic ash generation: Effects of componentry, particle size and conduit geometry on size-reduction processes. Earth and Planetary Science Letters, 514, 13–27. https://doi.org/10.1016/j.epsl.2019.02.028\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.jvolgeores.2006.11.005",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Platz, T., Cronin, S. J., Cashman, K. V., Stewart, R. B., & Smith, I. E. M. (2007). Transition from effusive to explosive phases in andesite eruptions — A case-study from the AD1655 eruption of Mt. Taranaki, New Zealand. Journal of Volcanology and Geothermal Research, 161(1–2), 15–34. https://doi.org/10.1016/j.jvolgeores.2006.11.005\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.jvolgeores.2008.03.023",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Scheu, B., Kueppers, U., Mueller, S., Spieler, O., & Dingwell, D. B. (2008). Experimental volcanology on eruptive products of Unzen volcano. Journal of Volcanology and Geothermal Research, 175(1–2), 110–119. https://doi.org/10.1016/j.jvolgeores.2008.03.023\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1007/s00445-016-1085-5",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Torres-Orozco, R., Cronin, S. J., Pardo, N., & Palmer, A. S. (2016). New insights into Holocene eruption episodes from proximal deposit sequences at Mt. Taranaki (Egmont), New Zealand. Bulletin of Volcanology, 79(1). https://doi.org/10.1007/s00445-016-1085-5\n",
                        "referenceType": "Cites"
                    }
                ],
                "laboratories": [
                    "Ludwig-Maximilians-University Munich, Munich, Germany",
                    "INGV Pisa: Istituto Nazionale di Geofisica e Vulcanologia, Pisa, Italy"
                ],
                "materials": [],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": []
            },
            {
                "title": "Mechanical data of simulated basalt-built faults from rotary shear and direct shear experiments",
                "name": "ec7e4b2a2a6444e09d3b814c4d6b006b",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/ec7e4b2a2a6444e09d3b814c4d6b006b",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2020.035",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2020.035",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "rock and melt physics"
                ],
                "description": "Here we report the raw data of the friction experiments carried out on basalt-built simulated faults defined by rock-on-rock contacts and powdered gouge. The experiments were specifically designed to investigate the role of fault microstructure on the frictional properties of basalts and the fault slip stability, and were conducted with the rotary-shear apparatus (SHIVA) and the biaxial deformation apparatus (BRAVA), hosted at the National Institute of Geophysics and Volcanology (INGV) in Rome.\n\nSimulated faults were sheared at constant normal stress from 4 to 30 MPa. In SHIVA experiments, we deformed samples at constant slip velocity of 10 μm/s up to 56 mm net slip. In BRAVA tests we performed a sequence of velocity steps (0.1 to 300 μm/s), followed by slide-hold-slide tests (30-3000 s holds; V=10 μm/s slides).\n\nOur main results highlight the frictionally strong nature of basalt faults and show opposite friction velocity dependence upon the velocity upsteps: while fault gouges exhibit velocity weakening behavior with increasing normal stress and sliding velocity, bare rock surfaces transition to velocity strengthening behavior as we approach higher slip velocities. The experiments setup and data are further described in the manuscript “Frictional properties of basalt experimental faults and implications for volcano-tectonic settings and geo-energy sites” to which these data are supplementary material.",
                "publicationDate": "",
                "citation": "Giacomel, P., Ruggieri, R., Scuderi, M. M., Spagnuolo, E., Di Toro, G., &amp; Collettini, C. (2021). <i>Mechanical data of simulated basalt-built faults from rotary shear and direct shear experiments</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2020.035",
                "creators": [
                    {
                        "authorName": "Giacomel, Piercarlo",
                        "authorIdentifier": "http://orcid.org/0000-0002-1553-7842",
                        "authorAffiliation": "Sapienza University of Rome, Rome, Italy"
                    },
                    {
                        "authorName": "Ruggieri, Roberta",
                        "authorIdentifier": "http://orcid.org/0000-0002-7051-4977",
                        "authorAffiliation": "Sapienza University of Rome, Rome, Italy"
                    },
                    {
                        "authorName": "Scuderi, Marco Maria",
                        "authorIdentifier": "http://orcid.org/0000-0001-5232-0792",
                        "authorAffiliation": "Sapienza University of Rome, Rome, Italy"
                    },
                    {
                        "authorName": "Spagnuolo, Elena",
                        "authorIdentifier": "http://orcid.org/0000-0002-1377-5812",
                        "authorAffiliation": "National Institute of Geophysics and Volcanology, Rome, Italy"
                    },
                    {
                        "authorName": "Di Toro, Giulio",
                        "authorIdentifier": "http://orcid.org/0000-0002-6618-3474",
                        "authorAffiliation": "Padua University, Padua, Italy"
                    },
                    {
                        "authorName": "Collettini, Cristiano",
                        "authorIdentifier": "http://orcid.org/0000-0002-4828-2516",
                        "authorAffiliation": "Sapienza University of Rome, Rome, Italy"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1146/annurev.earth.26.1.643",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Marone, C. (1998). LABORATORY-DERIVED FRICTION LAWS AND THEIR APPLICATION TO SEISMIC FAULTING. Annual Review of Earth and Planetary Sciences, 26(1), 643–696. https://doi.org/10.1146/annurev.earth.26.1.643\n",
                        "referenceType": "References"
                    },
                    {
                        "referenceIdentifier": "10.1029/93jb03361",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Scott, D. R., Marone, C. J., & Sammis, C. G. (1994). The apparent friction of granular fault gouge in sheared layers. Journal of Geophysical Research, 99(B4), 7231. https://doi.org/10.1029/93jb03361\n",
                        "referenceType": "References"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2021.228883",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Giacomel, P., Ruggieri, R., Scuderi, M. M., Spagnuolo, E., Di Toro, G., & Collettini, C. (2021). Frictional properties of basalt experimental faults and implications for volcano-tectonic settings and geo-energy sites. Tectonophysics, 811, 228883. https://doi.org/10.1016/j.tecto.2021.228883\n",
                        "referenceType": "IsSupplementTo"
                    }
                ],
                "laboratories": [
                    "INGV,  Italy"
                ],
                "materials": [],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": []
            },
            {
                "title": "Images and videos of analogue centrifuge models exploring marginal flexure during rifting in Afar, East Africa",
                "name": "478b27a26623e7754f1939a1ad822992",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/478b27a26623e7754f1939a1ad822992",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2020.020",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2020.020",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "analogue modelling of geologic processes",
                    "rock and melt physics"
                ],
                "description": "This data set includes images and videos depicting the evolution of deformation and topography of 17 analogue experiments c passive margin development, to better understand the ongoing tectonics along the western margin of Afar, East Africa. The tectonic background that forms the basis for the experimental design is found in Zwaan et al. 2019 and 2020a-b, and references therein. The experiments, in an enhanced gravity field in a large-capacity centrifuge, examined the influence of brittle layer thickness, strength contrast, syn-rift sedimentation and oblique extension on a brittle-viscous system with a strong and weak viscous domain. \n\nAll experiments were performed at the Tectonic Modelling Laboratory of of the Istituto di Geoscience e Georisorse - Consiglio Nazionale delle Ricerche (CNR-IGG) and of the Earth Sciences Department of the University of Florence (CNR/UF). The brittle layer (sand) thickness ranged between 6 and 20 mm, the underlying viscous layer, split in a competent and weak domain (both viscous mixtures), was always 10 mm thick. Asymmetric extension was applied by removing a 1.5 mm thick spacer at the side of the model at every time step, allowing the analogue materials to spread when enhanced gravity was applied during a centrifuge run.\n\nDifferential stretching of the viscous material creates flexure and faulting in the overlying brittle layer. Total extension amounted to 10.5 mm over 7 intervals for Series 1 models that aimed at understanding generic passive margin development in a generic orthogonal extension setting, whereas up to 16.5 mm of extension was applied for the additional Series 2 models aiming at reproducing the tectonic phases in Afar. In models involving sedimentation, sand was filled in at time steps 2, 4 and 6 (i.e. after 3, 6 and 9 mm of extension). Detailed descriptions of the experiments, monitoring techniques and tectonic interpretation of the model results are presented in Zwaan et al. (2020c) to which these data are supplementary.\n",
                "publicationDate": "",
                "citation": "Zwaan, F., Corti, G., Keir, D., &amp; Sani, F. (2020). <i>Images and videos of analogue centrifuge models exploring marginal flexure during rifting in Afar, East Africa</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2020.020",
                "creators": [
                    {
                        "authorName": "Zwaan, Frank",
                        "authorIdentifier": "http://orcid.org/0000-0001-8226-2132",
                        "authorAffiliation": "University of Florence, Florence, Italy"
                    },
                    {
                        "authorName": "Corti, Giacomo",
                        "authorIdentifier": "http://orcid.org/0000-0001-7399-4438",
                        "authorAffiliation": "CNR Italian National Research Council, Italy"
                    },
                    {
                        "authorName": "Keir, Derek",
                        "authorIdentifier": "http://orcid.org/0000-0001-8787-8446",
                        "authorAffiliation": "University of Southampton, Southampton, UK"
                    },
                    {
                        "authorName": "Sani, Federico",
                        "authorIdentifier": "http://orcid.org/0000-0001-8832-1471",
                        "authorAffiliation": "University of Florence, Florence, Italy"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2020.228595",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Corti, G., Keir, D., & Sani, F. (2020). Analogue modelling of marginal flexure in Afar, East Africa: Implications for passive margin formation. Tectonophysics, 796, 228595. https://doi.org/10.1016/j.tecto.2020.228595\n",
                        "referenceType": "IsSupplementTo"
                    },
                    {
                        "referenceIdentifier": "10.5880/fidgeo.2020.017",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Corti, G., Keir, D., Sani, F., Muluneh, A., Illsley-Kemp, F., &amp; Papini, M. (2020). <i>Geological data from the Western Afar Margin, East Africa</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2020.017",
                        "referenceType": "References"
                    },
                    {
                        "referenceIdentifier": "10.5880/fidgeo.2020.018",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Rudolf, M., Corti, G., Keir, D., &amp; Sani, F. (2020). <i>Rheology of viscous materials from the CNR-IGG Tectonic Modelling Laboratory at the University of Florence (Italy)</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2020.018",
                        "referenceType": "References"
                    },
                    {
                        "referenceIdentifier": "10.5880/fidgeo.2020.019",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Rudolf, M., Pohlenz, A., Corti, G., Keir, D., &amp; Sani, F. (2020). <i>Ring-shear test data of feldspar sand from the CNR-IGG Tectonic Modelling Laboratory at the University of Florence (Italy)</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2020.019",
                        "referenceType": "References"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.jafrearsci.2019.103649",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Corti, G., Keir, D., & Sani, F. (2020). A review of tectonic models for the rifted margin of Afar: Implications for continental break-up and passive margin formation. Journal of African Earth Sciences, 164, 103649. https://doi.org/10.1016/j.jafrearsci.2019.103649\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1029/2019TC006043",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Corti, G., Sani, F., Keir, D., Muluneh, A. A., Illsley‐Kemp, F., & Papini, M. (2020). Structural Analysis of the Western Afar Margin, East Africa: Evidence for Multiphase Rotational Rifting. Tectonics, 39(7). Portico. https://doi.org/10.1029/2019tc006043\n",
                        "referenceType": "Cites"
                    }
                ],
                "laboratories": [],
                "materials": [],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": [
                    "strain"
                ]
            },
            {
                "title": "Pictures, DEMs, and raw data relative to analogue accretionary wedges",
                "name": "c9c56b165035960d91d3eadb402978af",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/c9c56b165035960d91d3eadb402978af",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2021.041",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2021.041",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "analogue modelling of geologic processes",
                    "rock and melt physics"
                ],
                "description": "This dataset includes raw data used in the paper by Reitano et al. (2022), focused on the effect of boundary conditions on the evolution of analogue accretionary wedges affected by both tectonics and surface processes; the paper also focuses on the balance between tectonics and surface processes as a function of the boundary conditions applied. These boundary conditions are convergence velocity and basal slope (i.e., the tilting toward the foreland imposed prior the experimental run). The experiments have been carried out at Laboratory of Experimental Tectonics (LET), University “Roma Tre” (Rome). Detailed descriptions of the experimental apparatus and experimental procedures implemented can be found in the paper to which this dataset refers. Here we present:\n•\tPictures recording the evolution of the models.\n•\tGIFs showing time-lapses of models.\n•\tRaw DEMs of the models and Incision DEMs, used for extracting data later discusses in the paper.",
                "publicationDate": "",
                "citation": "Reitano, R., Faccenna, C., Funiciello, F., Corbi, F., Sternai, P., Willett, S. D., Sembroni, A., &amp; Lanari, R. (2021). <i>Pictures, DEMs, and raw data relative to analogue accretionary wedges</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2021.041",
                "creators": [
                    {
                        "authorName": "Reitano, Riccardo",
                        "authorIdentifier": "http://orcid.org/0000-0002-6295-5588",
                        "authorAffiliation": "Universitá degli studi \"Roma TRE\", Rome, Italy"
                    },
                    {
                        "authorName": "Faccenna, Claudio",
                        "authorIdentifier": "http://orcid.org/ 0000-0003-0765-4165 ",
                        "authorAffiliation": "Universitá degli studi \"Roma TRE\", Rome, Italy"
                    },
                    {
                        "authorName": "Funiciello, Francesca",
                        "authorIdentifier": "http://orcid.org/0000-0001-7900-8272",
                        "authorAffiliation": "Universitá degli studi \"Roma TRE\", Rome, Italy"
                    },
                    {
                        "authorName": "Corbi, Fabio",
                        "authorIdentifier": "http://orcid.org/0000-0003-2662-3065",
                        "authorAffiliation": "National Research Council - CNR, Istituto di Geologia Ambientale e Geoingegneria"
                    },
                    {
                        "authorName": "Sternai, Pietro",
                        "authorIdentifier": "http://orcid.org/0000-0003-1891-6474",
                        "authorAffiliation": "Università degli Studi di Milano-Bicocca, Milano, Italy"
                    },
                    {
                        "authorName": "Willett, Sean D.",
                        "authorIdentifier": "http://orcid.org/ 0000-0002-8408-0567 ",
                        "authorAffiliation": "Swiss Federal Institute of Technology in Zurich, Zurich, Switzerland"
                    },
                    {
                        "authorName": "Sembroni, Andrea",
                        "authorIdentifier": "http://orcid.org/0000-0003-4672-6125 ",
                        "authorAffiliation": "Università di Bologna “Alma mater studiorum”"
                    },
                    {
                        "authorName": "Lanari, Riccardo",
                        "authorIdentifier": "http://orcid.org/0000-0002-8304-6367 ",
                        "authorAffiliation": "Università degli Studi di Firenze Dipartimento di Scienze della Terra, Firenze, Toscana, Italy"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1029/2021TC006951",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Reitano, R., Faccenna, C., Funiciello, F., Corbi, F., Sternai, P., Willett, S. D., Sembroni, A., & Lanari, R. (2022). Sediment Recycling and the Evolution of Analog Orogenic Wedges. Tectonics, 41(2). Portico. https://doi.org/10.1029/2021tc006951\n",
                        "referenceType": "IsSupplementTo"
                    },
                    {
                        "referenceIdentifier": "10.3390/geosciences11100412",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Garcia-Estève, C., Caniven, Y., Cattin, R., Dominguez, S., & Sylvain, R. (2021). Morphotectonic Evolution of an Alluvial Fan: Results of a Joint Analog and Numerical Modeling Approach. Geosciences, 11(10), 412. https://doi.org/10.3390/geosciences11100412\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.crte.2008.01.005",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Graveleau, F., & Dominguez, S. (2008). Analogue modelling of the interaction between tectonics, erosion and sedimentation in foreland thrust belts. Comptes Rendus Geoscience, 340(5), 324–333. https://doi.org/10.1016/j.crte.2008.01.005\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2011.09.029",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Graveleau, F., Hurtrez, J.-E., Dominguez, S., & Malavieille, J. (2011). A new experimental material for modeling relief dynamics and interactions between tectonics and surface processes. Tectonophysics, 513(1–4), 68–87. https://doi.org/10.1016/j.tecto.2011.09.029\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2016.04.016",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Guerit, L., Dominguez, S., Malavieille, J., & Castelltort, S. (2016). Deformation of an experimental drainage network in oblique collision. Tectonophysics, 693, 210–222. https://doi.org/10.1016/j.tecto.2016.04.016\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1029/2020TC006515",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Mao, Y., Li, Y., Yan, B., Wang, X., Jia, D., & Chen, Y. (2021). Response of Surface Erosion to Crustal Shortening and its Influence on Tectonic Evolution in Fold‐and‐Thrust Belts: Implications From Sandbox Modeling on Tectonic Geomorphology. Tectonics, 40(5). Portico. https://doi.org/10.1029/2020tc006515\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.5194/esurf-8-973-2020",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Reitano, R., Faccenna, C., Funiciello, F., Corbi, F., & Willett, S. D. (2020). Erosional response of granular  material in landscape models. Earth Surface Dynamics, 8(4), 973–993. https://doi.org/10.5194/esurf-8-973-2020\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.geomorph.2016.02.022",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Sembroni, A., Molin, P., Pazzaglia, F. J., Faccenna, C., & Abebe, B. (2016). Evolution of continental-scale drainage in response to mantle dynamics and surface processes: An example from the Ethiopian Highlands. Geomorphology, 261, 12–29. https://doi.org/10.1016/j.geomorph.2016.02.022\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.5194/esurf-2-1-2014",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Schwanghart, W., & Scherler, D. (2014). Short Communication: TopoToolbox 2 – MATLAB-based software for topographic analysis and modeling in Earth surface sciences. Earth Surface Dynamics, 2(1), 1–7. https://doi.org/10.5194/esurf-2-1-2014\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2011.10.005",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Strak, V., Dominguez, S., Petit, C., Meyer, B., & Loget, N. (2011). Interaction between normal fault slip and erosion on relief evolution: Insights from experimental modelling. Tectonophysics, 513(1–4), 1–19. https://doi.org/10.1016/j.tecto.2011.10.005\n",
                        "referenceType": "Cites"
                    }
                ],
                "laboratories": [
                    "Universitá degli studi \"Roma TRE\", Rome, Italy"
                ],
                "materials": [],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": []
            },
            {
                "title": "Decorated dislocations and (HR-)EBSD data from olivine of the Oman-UAE ophiolite",
                "name": "e68384f947745fda0ffbdb43cf1e8ae2",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/e68384f947745fda0ffbdb43cf1e8ae2",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2021.050",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2021.050",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "rock and melt physics"
                ],
                "description": "This dataset is supplemental to the paper Wallis et al. (2021) and contains data on dislocations and their stress fields in olivine from the Oman-UAE ophiolite measured by oxidation decoration, electron backscatter diffraction (EBSD) and high-angular resolution electron backscatter diffraction (HR-EBSD). The datasets include images of decorated dislocations, measurements of lattice orientation and misorientations, densities of geometrically necessary dislocations, and heterogeneity in residual stress. Data are provided as 6 TIF files, 8 CTF files, and 37 tab-delimited TXT files. Files are organised by the figure in which the data are presented in the main paper. Data types or sample numbers are also indicated in the file names.    \n ",
                "publicationDate": "",
                "citation": "Wallis, D., Sep, M., &amp; Hansen, L. N. (2021). <i>Decorated dislocations and (HR-)EBSD data from olivine of the Oman-UAE ophiolite</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2021.050",
                "creators": [
                    {
                        "authorName": "Wallis, David",
                        "authorIdentifier": "http://orcid.org/0000-0001-9212-3734",
                        "authorAffiliation": "University of Cambridge, Department of Earth Sciences, Cambridge, UK"
                    },
                    {
                        "authorName": "Sep, Mike",
                        "authorIdentifier": "http://orcid.org/0000-0002-1316-4237",
                        "authorAffiliation": "Utrecht University, Department of Earth Sciences, Utrecht, The Netherlands"
                    },
                    {
                        "authorName": "Hansen, Lars N.",
                        "authorIdentifier": "http://orcid.org/0000-0001-6212-1842",
                        "authorAffiliation": "University of Minnesota-Twin Cities, Minneapolis, USA"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1029/2021JB022618",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Wallis, D., Sep, M., & Hansen, L. N. (2022). Transient Creep in Subduction Zones by Long‐Range Dislocation Interactions in Olivine. Journal of Geophysical Research: Solid Earth, 127(1). Portico. https://doi.org/10.1029/2021jb022618\n",
                        "referenceType": "IsSupplementTo"
                    },
                    {
                        "referenceIdentifier": "10.1029/97jb00682",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Abramson, E. H., Brown, J. M., Slutsky, L. J., & Zaug, J. (1997). The elastic constants of San Carlos olivine to 17 GPa. Journal of Geophysical Research: Solid Earth, 102(B6), 12253–12263. Portico. https://doi.org/10.1029/97jb00682\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.epsl.2018.03.027",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Ambrose, T. K., Wallis, D., Hansen, L. N., Waters, D. J., & Searle, M. P. (2018). Controls on the rheological properties of peridotite at a palaeosubduction interface: A transect across the base of the Oman–UAE ophiolite. Earth and Planetary Science Letters, 491, 193–206. https://doi.org/10.1016/j.epsl.2018.03.027\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.ultramic.2011.05.007",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Britton, T. B., & Wilkinson, A. J. (2011). Measurement of residual elastic strain and lattice rotations with high resolution electron backscatter diffraction. Ultramicroscopy, 111(8), 1395–1404. https://doi.org/10.1016/j.ultramic.2011.05.007\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.ultramic.2012.01.004",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Britton, T. B., & Wilkinson, A. J. (2012). High resolution electron backscatter diffraction measurements of elastic strain variations in the presence of larger lattice rotations. Ultramicroscopy, 114, 82–95. https://doi.org/10.1016/j.ultramic.2012.01.004\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.matchar.2016.04.008",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Britton, T. B., Jiang, J., Guo, Y., Vilalta-Clemente, A., Wallis, D., Hansen, L. N., Winkelmann, A., & Wilkinson, A. J. (2016). Tutorial: Crystal orientations and EBSD — Or which way is up? Materials Characterization, 117, 113–126. https://doi.org/10.1016/j.matchar.2016.04.008\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1126/science.191.4231.1045",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Kohlstedt, D. L., Goetze, C., Durham, W. B., & Vander Sande, J. (1976). New Technique for Decorating Dislocations in Olivine. Science, 191(4231), 1045–1046. https://doi.org/10.1126/science.191.4231.1045\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.ultramic.2016.06.002",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Wallis, D., Hansen, L. N., Ben Britton, T., & Wilkinson, A. J. (2016). Geometrically necessary dislocation densities in olivine obtained using high-angular resolution electron backscatter diffraction. Ultramicroscopy, 168, 34–45. https://doi.org/10.1016/j.ultramic.2016.06.002\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1029/2019JB017867",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Wallis, D., Hansen, L. N., Britton, T. B., & Wilkinson, A. J. (2019). High‐Angular Resolution Electron Backscatter Diffraction as a New Tool for Mapping Lattice Distortion in Geological Minerals. Journal of Geophysical Research: Solid Earth, 124(7), 6337–6358. Portico. https://doi.org/10.1029/2019jb017867\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1016/j.ultramic.2005.10.001",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Wilkinson, A. J., Meaden, G., & Dingley, D. J. (2006). High-resolution elastic strain measurement from electron backscatter diffraction patterns: New levels of sensitivity. Ultramicroscopy, 106(4–5), 307–313. https://doi.org/10.1016/j.ultramic.2005.10.001\n",
                        "referenceType": "Cites"
                    }
                ],
                "laboratories": [
                    "Utrecht University,  The Netherlands"
                ],
                "materials": [
                    "olivine",
                    "peridotite"
                ],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": []
            },
            {
                "title": "PIV and topographic analysis data from analogue experiments involving 3D structural inheritance and multiphase rifting",
                "name": "a579f549550e4c860fd6b57e67c647d6",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/a579f549550e4c860fd6b57e67c647d6",
                "pid": [
                    {
                        "identifier": "10.5880/fidgeo.2021.042",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/fidgeo.2021.042",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "analogue modelling of geologic processes",
                    "rock and melt physics"
                ],
                "description": "This data set includes videos depicting the surface evolution (time-lapse photographs and Particle Image Velocimetry or PIV analysis) of 38 analogue models, in five model series (A-E), simulating rift tectonics. In these experiments we examined the influence of differently oriented mantle and crustal weaknesses on rift system development during multiphase rifting (i.e. rifting involving changing divergence directions or -rates) using brittle-viscous set-ups. All experiments were performed at the Tectonic Modelling Laboratory of the University of Bern (UB).  \n\nThe brittle and viscous layers, representing the upper an lower crust, were 3 cm and 1 cm thick, respectively, whereas a mantle weakness was simulated using the edge of a moving basal plate (a velocity discontinuity or VD). Crustal weaknesses were simulated using “seeds” (ridges of viscous material at the base of the brittle layers that locally weaken these brittle layers). The divergence rate for the Model A reference models was 20 mm/h so that the model duration of 2:30 h yielded a total divergence of 5 cm (so that e = 17%, given an initial model width of ca. 30 cm). Multiphase rifting model series B and C involved both a slow (10 mm/h) and fast (100 mm/h) rifting phase of 2.5 cm divergence each, for a total of 5 cm of divergence over a 2:45 h period. Multiphase rifting models series D and E had the same divergence rates (20 mm/h) as the Series A reference models, but involved both an orthogonal (α = 0˚) and oblique rifting (α = 30˚) phase of 2.5 cm divergence each, for a total of 5 cm of divergence over a 2:30 h period. In our models the divergence obliquity angle α was defined as the angle between the normal to the central model axis and the direction of divergence. The orientation and arrangements of the simulated mantle and crustal weaknesses is defined by angle θ (defined as the direction of the weakness with respect to the model axis. An overview of model parameters is provided in Table 1, and detailed descriptions of the model set-up and results, as well as the monitoring techniques can be found in Zwaan et al. (2021).  \n",
                "publicationDate": "",
                "citation": "Zwaan, F., Chenin, P., Erratt, D., Manatschal, G., &amp; Schreurs, G. (2021). <i>PIV and topographic analysis data from analogue experiments involving 3D structural inheritance and multiphase rifting</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/FIDGEO.2021.042",
                "creators": [
                    {
                        "authorName": "Zwaan, Frank",
                        "authorIdentifier": "http://orcid.org/0000-0001-8226-2132",
                        "authorAffiliation": "University of Bern, Bern, Switzerland"
                    },
                    {
                        "authorName": "Chenin, Pauline",
                        "authorIdentifier": "http://orcid.org/0000-0002-2151-5148",
                        "authorAffiliation": "Université de Strasbourg, CNRS, ENGEES, ITES UMR 7063, Strasbourg, France"
                    },
                    {
                        "authorName": "Erratt, Duncan",
                        "authorIdentifier": "",
                        "authorAffiliation": "Université de Strasbourg, CNRS, ENGEES, ITES UMR 7063, Strasbourg, France"
                    },
                    {
                        "authorName": "Manatschal, Gianreto",
                        "authorIdentifier": "http://orcid.org/0000-0003-3834-2033",
                        "authorAffiliation": "Université de Strasbourg, CNRS, ENGEES, ITES UMR 7063, Strasbourg, France"
                    },
                    {
                        "authorName": "Schreurs, Guido",
                        "authorIdentifier": "http://orcid.org/0000-0002-4544-7514",
                        "authorAffiliation": "University of Bern, Bern, Switzerland"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1111/bre.12642",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Zwaan, F., Chenin, P., Erratt, D., Manatschal, G., & Schreurs, G. (2021). Competition between 3D structural inheritance and kinematics during rifting: Insights from analogue models. Basin Research, 34(2), 824–854. Portico. https://doi.org/10.1111/bre.12642\n",
                        "referenceType": "IsSupplementTo"
                    }
                ],
                "laboratories": [
                    "University of Bern, Bern, Switzerland"
                ],
                "materials": [
                    "corundum sand",
                    "quartz sand"
                ],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": [
                    "strain"
                ]
            },
            {
                "title": "Ring Shear and Slide-Hold-Slide Test Measurements for Soda-Lime Glassbeads of 300-400µm diameter used \nat the Helmholtz Laboratory for Tectonic Modelling, Potsdam, Germany",
                "name": "24a2dc4213d29f0a3bb060f93283e712",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/24a2dc4213d29f0a3bb060f93283e712",
                "pid": [
                    {
                        "identifier": "10.5880/GFZ.4.1.2021.002",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/GFZ.4.1.2021.002",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "analogue modelling of geologic processes",
                    "rock and melt physics"
                ],
                "description": "This data set provides two series of experiments from ring-shear tests (RST) on glass beads that are in use at the Helmholtz Laboratory for Tectonic Modelling (HelTec) at the GFZ German Research Centre for Geosciences in Potsdam. The main experimental series contains shear experiments to analyse the slip behaviour of the granular material under analogue experiment conditions. Additionally, a series of slide-hold-slide (SHS) tests was used to determine the rate and state friction properties. A basic characterisation and average friction coefficients of the glass beads are found in Pohlenz et al. (2020).\n\nThe glass beads show a slip behaviour that is depending on loading rate, normal stress and apparatus stiffness which were varied systematically for this study. The apparatus was modified with springs resulting in 4 different stiffnesses. For each stiffness a set of 4 experiments with different normal stresses (5, 10, 15 and 20 kPa) were performed. During each experiment loading rate was decreased from 0.02 to 0.0008 mm/s resulting in 9 subsets of constant velocity for each experiment. We observe a large variety of slip modes that ranges from pure stick-slip to steady state creep. The main characteristics of these slip modes are the slip velocity and the ratio of slip event duration compared to no slip phases. \n\nWe find that high loading rates promote stable slip, while low loading rates lead to stick-slip cycles. Lowering the normal stress leads to a larger amount of creep which changes the overall shape of a stick-slip curve and extends the time between slip events. Changing stiffness leads to an overall change in slip behaviour switching from simple stick-slip to more complex patterns of slip modes including oscillations and bimodal slip events with large and small events.\n\nThe SHS tests were done at maximum stiffness and higher loading rates (>0.05 mm/s) but at the same normal stress intervals as the main series. Using various techniques, we estimate the rate-and-state constitutive parameters. The peak stress after a certain amount of holding increases with a healing rate of b=0.0057±0.0005. From the increase in peak stress compared to the loading rate in slide-hold-slide tests we compute a direct effect a=-0.0076±0.0005 which leads to (a-b)=-0.0130±0.0006. Using a specific subset of the SHS tests, which have an equal ratio of hold time to reloading rate, we estimate (a-b)=-0.0087±0.0029. Both approaches show that the material is velocity weakening with a reduction in friction of 1.30 to 0.87 % per e-fold increase in loading rate. Additionally, the critical slip distance Dc is estimated to be in the range of 200 µm. With these parameters the theoretical critical stiffness kc is estimated and applied to the slip modes found in the main series. \n\nWe find that the changes in slip mode are in good agreement with the estimated critical stiffness and thus confirm the findings from the SHS tests.",
                "publicationDate": "",
                "citation": "Rudolf, M., Rosenau, M., &amp; Oncken, O. (2021). <i>Ring Shear and Slide-Hold-Slide Test Measurements for Soda-Lime Glassbeads of 300-400µm diameter used at the Helmholtz Laboratory for Tectonic Modelling, Potsdam, Germany</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/GFZ.4.1.2021.002",
                "creators": [
                    {
                        "authorName": "Rudolf, Michael",
                        "authorIdentifier": "http://orcid.org/0000-0002-5077-5221",
                        "authorAffiliation": "GFZ German Research Centre for Geosciences, Potsdam, Germany"
                    },
                    {
                        "authorName": "Rosenau, Matthias",
                        "authorIdentifier": "http://orcid.org/0000-0003-1134-5381",
                        "authorAffiliation": "GFZ German Research Centre for Geosciences, Potsdam, Germany"
                    },
                    {
                        "authorName": "Oncken, Onno",
                        "authorIdentifier": "http://orcid.org/0000-0002-2894-480X",
                        "authorAffiliation": "GFZ German Research Centre for Geosciences, Potsdam, Germany"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1016/j.tecto.2016.01.017",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Klinkmüller, M., Schreurs, G., Rosenau, M., & Kemnitz, H. (2016). Properties of granular analogue model materials: A community wide survey. Tectonophysics, 684, 23–38. https://doi.org/10.1016/j.tecto.2016.01.017\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.5880/GFZ.4.1.2020.008",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Pohlenz, A., Rudolf, M., Kemnitz, H., &amp; Rosenau, M. (2020). <i>Ring shear test data of glass beads 300-400 µm used for analogue experiments in the Helmholtz Laboratory for Tectonic Modelling (HelTec) at the GFZ German Research Centre for Geosciences in Potsdam</i> [Data set]. GFZ Data Services. https://doi.org/10.5880/GFZ.4.1.2020.008",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1002/2016JB012915",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Ritter, M. C., Leever, K., Rosenau, M., & Oncken, O. (2016). Scaling the sandbox-Mechanical (dis) similarities of granular materials and brittle rock. Journal of Geophysical Research: Solid Earth, 121(9), 6863–6879. Portico. https://doi.org/10.1002/2016jb012915\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1002/ceat.200303112",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Schulze, D. (2003). Time- and Velocity-Dependent Properties of Powders Effecting Slip-Stick Oscillations. Chemical Engineering &amp; Technology, 26(10), 1047–1051. https://doi.org/10.1002/ceat.200303112\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1007/978-3-540-73768-1",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Powders and Bulk Solids. (2007). https://doi.org/10.1007/978-3-540-73768-1\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "10.1029/2021GC009825",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Rudolf, M., Rosenau, M., & Oncken, O. (2021). The Spectrum of Slip Behaviors of a Granular Fault Gouge Analogue Governed by Rate and State Friction. Geochemistry, Geophysics, Geosystems, 22(12). Portico. https://doi.org/10.1029/2021gc009825\n",
                        "referenceType": "IsSupplementTo"
                    },
                    {
                        "referenceIdentifier": "10.5880/GFZ.4.1.2021.007",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Rudolf, M. (2021). <i>RST-Stick-Slipy</i> (Version 1.0) [Computer software]. GFZ Data Services. https://doi.org/10.5880/GFZ.4.1.2021.007",
                        "referenceType": "IsSupplementedBy"
                    }
                ],
                "laboratories": [
                    "GFZ German Research Centre for Geosciences, Potsdam, Germany"
                ],
                "materials": [],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": [
                    "friction coefficient"
                ]
            },
            {
                "title": "Digital Image Correlation of strike slip experiments in wet kaolin at different strain rates and boundary conditions",
                "name": "737e14bb93ae2077767bb001cf3dbec0",
                "portalLink": "https://acc.epos-msl.uu.nl/data-publication/737e14bb93ae2077767bb001cf3dbec0",
                "pid": [
                    {
                        "identifier": "10.5880/GFZ.fidgeo.2021.029",
                        "identifierType": "doi"
                    }
                ],
                "license": "CC BY 4.0",
                "version": "",
                "source": "http://doi.org/10.5880/GFZ.fidgeo.2021.029",
                "publisher": "f2eec361-a5fb-4400-a39d-b3f8435cc858",
                "subdomain": [
                    "analogue modelling of geologic processes",
                    "rock and melt physics"
                ],
                "description": "The data set includes the digital image correlation of 16 dextral strike-slip experiments performed at the University of Massachusetts at Amherst (USA).  The DIC data sets were used for a machine learning project to build a CNN that can predict off-fault deformation from active fault trace maps. The experimental set up and methods are described with the main text and supplement to Chaipornkaew et al (in prep). To map active fault geometry and calculate the off-fault deformation we use the Digital Image Correlation (DIC) technique of Particle Image Velocimetry (PIV) to produce incremental horizontal displacement maps.  Strain maps of the entire region of interest can be calculated from the displacements maps to determine the fault maps and estimate off-fault strain throughout the Region of Interest (ROI). We subdivide each ROI into five subdomains, windows, for training the CNN.  This allows a larger dataset from the experimental results. The data posted here include the incremental displacement time series and animations of strain for the entire ROI.",
                "publicationDate": "",
                "citation": "Cooke, M., Elston, H., &amp; Chaipornkaew, L. (2021). <i>Digital Image Correlation of strike slip experiments in wet kaolin at different strain rates and boundary conditions</i> (Version 1) [Data set]. GFZ Data Services. https://doi.org/10.5880/GFZ.FIDGEO.2021.029",
                "creators": [
                    {
                        "authorName": "Cooke, Michele",
                        "authorIdentifier": "http://orcid.org/0000-0002-4407-9676",
                        "authorAffiliation": "University of Massachusetts, Amherst, US"
                    },
                    {
                        "authorName": "Elston, Hanna",
                        "authorIdentifier": "http://orcid.org/0000-0002-2420-5241",
                        "authorAffiliation": "University of Massachusetts, Amherst, US"
                    },
                    {
                        "authorName": "Chaipornkaew, Laainam",
                        "authorIdentifier": "http://orcid.org/0000-0003-2021-3655",
                        "authorAffiliation": "Stanford University, Stanford, US"
                    }
                ],
                "contributors": [],
                "references": [
                    {
                        "referenceIdentifier": "10.1002/essoar.10507909.1",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Chaipornkaew, L., Elston, H., Cooke, M. L., Mukerji, T., & Graham, S. A. (2021). Prediction of Off-Fault Deformation from Experimental Strike-slip Fault Structures using the Convolutional Neural Networks. https://doi.org/10.1002/essoar.10507909.1\n",
                        "referenceType": "IsSupplementTo"
                    },
                    {
                        "referenceIdentifier": "10.1080/2151237X.2007.10129236 ",
                        "referenceIdentifierType": "DOI",
                        "referenceTitle": "Bradley, D., & Roth, G. (2007). Adaptive Thresholding using the Integral Image. Journal of Graphics Tools, 12(2), 13–21. https://doi.org/10.1080/2151237x.2007.10129236\n",
                        "referenceType": "Cites"
                    },
                    {
                        "referenceIdentifier": "https://www.mathworks.com/matlabcentral/fileexchange/27659-pivlab-particle-image-velocimetry-piv-tool",
                        "referenceIdentifierType": "URL",
                        "referenceTitle": "",
                        "referenceType": "Cites"
                    }
                ],
                "laboratories": [
                    "University of Massachusetts, Amherst, US"
                ],
                "materials": [
                    "clay"
                ],
                "spatial": [],
                "locations": [],
                "coveredPeriods": [],
                "collectionPeriods": [],
                "maintainer": "",
                "downloads": [],
                "researchAspects": []
            }
        ]
    }
}
```

</details>

## test