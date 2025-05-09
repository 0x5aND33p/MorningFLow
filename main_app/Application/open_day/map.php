<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Arrange items vertically */
            align-items: center; /* Center horizontally */
            /* justify-content: center; */ /* Remove vertical centering */
            min-height: 100vh;
            background-color: #f0f2f5;
            background-image: url('uniPic.jpg');
            background-size: cover;
            background-position: center;
        }

        .main-container {
            background-color: rgba(255, 253, 245, 0.95);
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            padding: 20px;
            box-sizing: border-box;
            width: 95%;
            max-width: 1200px;
            margin-top: 20px; /* Add some top margin to separate from navbar */
        }

        .title {
            color: #003366;
            font-size: clamp(2.0rem, 3vw, 2.5rem);
            font-weight: 700;
            text-align: left;
            margin-bottom: 1rem;
        }

        .divider {
            width: 100%;
            height: 3px;
            margin: 0.5rem 0 1rem 0;
            border: none;
            background: linear-gradient(to right, #555 0%, #999 30%, transparent 100%);
        }

        .map-section {
            position: relative;
            width: 100%;
            text-align: center;
            margin-top: 1.5rem;
        }

        #mapimage {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-map {
            position: absolute;
            padding: 0.75rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transform: translate(-50%, -50%);
            white-space: nowrap;
            text-align: left;
            font-weight: 600;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out;
            z-index: 10;
        }

        .btn-map:hover {
            background-color: #0056b3;
            transform: translate(-50%, -50%) scale(1.05);
        }

        .challenges-btn {
            display: block;
            margin: 1.5rem auto;
            padding: 0.75rem 1.5rem;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 0.25rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out, transform 0.15s ease-in-out;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .challenges-btn:hover {
            background-color: #1e7e34;
            transform: scale(1.02);
        }

        .chatbot-wrapper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <?php include("navbar.html"); ?>

    <div class="main-container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="title">Let's Explore the University</h1>
                <hr class="divider">
                <p class="lead">Explore the campus. Select a building name on the map to get more information.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 map-section">
                <img id="mapimage" src="University.png" alt="Static Map" class="img-fluid">
                <button class="btn-map" id="btn1" style="top: 30%; left: 30%;">MD Building </button>
                <button class="btn-map" id="btn2" style="top: 10%; left: 50%;">MC Building </button>
                <button class="btn-map" id="btn3" style="top: 60%; left: 38%;">MA Building</button>
                <button class="btn-map" id="btn4" style="top: 33%; left: 70%;">MI Building</button>
                <button id="challenges-btn" class="btn btn-success w-100 mt-3">Take The Challenges</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 id="modal-modal-title">Information</h2>
                    <p id="modal-modal-text">This is the default information.</p>
                    <div class="scrolling-images d-flex overflow-auto mt-2" id="modal-scrolling-images"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="overlay" class="overlay" style="display: none;"></div>

    <div class="chatbot-wrapper">
        <df-messenger
            intent="WELCOME"
            chat-title="PathFinder"
            agent-id="ff5fd13d-16da-486c-b432-2542cdca2286"
            language-code="en">
        </df-messenger>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
        const modalTitle = document.getElementById('modal-modal-title');
        const modalText = document.getElementById('modal-modal-text');
        const modalScrollingImagesContainer = document.getElementById('modal-scrolling-images');

        function openModal(title, text, images = []) {
            modalTitle.textContent = title;
            modalText.innerHTML = text;
            modalScrollingImagesContainer.innerHTML = '';
            images.forEach(image => {
                const imgElement = document.createElement('img');
                imgElement.src = image;
                imgElement.classList.add('me-2');
                imgElement.style.width = '280px';
                imgElement.style.height = '200px';
                imgElement.style.borderRadius = '5px';
                imgElement.style.objectFit = 'cover';
                imgElement.flexShrink = '0';
                modalScrollingImagesContainer.appendChild(imgElement);
            });
            infoModal.show();
            ImageScroll(modalScrollingImagesContainer);
        }

        function ImageScroll(container) {
            const scrollSpeed = 1;
            let scrollPosition = 0;

            function scroll() {
                scrollPosition += scrollSpeed;
                if (scrollPosition >= container.scrollWidth - container.clientWidth) {
                    scrollPosition = 0;
                }
                container.scrollLeft = scrollPosition;
                requestAnimationFrame(scroll);
            }
            scroll();
        }

        document.getElementById('btn1').addEventListener('click', function() {
            openModal(
                'Ambika Paul Building',
                `The current student gateway, MD Building is home to the main library, Students' Union, sports centre and help and advice points.<br><br>
                Its facilities are:
                <ul>
                    <li>GO Shop</li>
                    <li>Student's Union</li>
                    <li>Careers and Employment Services (ODOS)</li>
                    <li>Harrison Learning Centre</li>
                    <li>Research Hub</li>
                    <li>Teaching Rooms</li>
                    <li>Sports Centre and Gym</li>
                </ul>`,
                ['image4.png', 'image5.jpg', 'image6.jpg']
            );
        });

        document.getElementById('btn2').addEventListener('click', function() {
            openModal(
                'Millennium City Building',
                `One of the main social spaces on campus, Millennium City Building (MC) includes our main dining areas, and Starbucks branch.<br><br>
                It's features are:
                <ul>
                    <li>Courtyard Kitchen</li>
                    <li>Costa Coffee</li>
                    <li>Lecture Theatre</li>
                    <li>Teaching Rooms</li>
                </ul>`,
                ['image1.png', 'image2.jpg', 'image3.jpg']
            );
        });

        document.getElementById('btn3').addEventListener('click', function() {
            openModal(
                'Wulfruna Building',
                `The historic MA Building houses the University's main reception, and is home to the Arena Theatre.<br><br>
                Its features are:
                <ul>
                    <li>Main Reception</li>
                    <li>Campus Operations</li>
                    <li>Offices of the Vice-Chancellor</li>
                    <li>Arena Theatre</li>
                    <li>Teaching Rooms</li>
                    <li>Lecture Theatres</li>
                </ul>`,
                ['image10.png', 'image11.jpg']
            );
        });

        document.getElementById('btn4').addEventListener('click', function() {
            openModal(
                'Alan Turing Building',
                `The Alan Turing Building (MI) contains several specialist laboratories designed to support the technical study carried out within the University.<br><br>
                Its facilities are:
                <ul>
                    <li>Student Centre South</li>
                    <li>Teaching Rooms</li>
                    <li>Student Enabling Centre (ODOS)</li>
                    <li>Media Centre</li>
                </ul>`,
                ['image7.jpg', 'image8.jpg', 'image9.jpg']
            );
        });

        document.getElementById('challenges-btn').addEventListener('click', function() {
            window.location.href = 'challenges.php';
        });
    </script>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
</body>
</html>