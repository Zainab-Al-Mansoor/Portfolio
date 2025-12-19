<?php
// ⭐CONTACT FORM HANDLING
include('connection.php');

// Form errors
$errors = [
    "name" => "",
    "email" => "",
    "subject" => "",
    "message" => ""
];

$success = "";
$showModal = false;

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validation
    if (empty($name)) $errors["name"] = "Name is required";
    if (empty($email)) $errors["email"] = "Email is required";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors["email"] = "Invalid email format";

    if (empty($subject)) $errors["subject"] = "Subject is required";
    if (empty($message)) $errors["message"] = "Message is required";

    if (!array_filter($errors)) {
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $subject = $conn->real_escape_string($subject);
        $message = $conn->real_escape_string($message);

        $sql = "INSERT INTO contact_messages (name, email, subject, message)
                VALUES ('$name', '$email', '$subject', '$message')";

        if ($conn->query($sql) === TRUE) {
            $success = "Your message has been sent successfully!";
            $showModal = true; 
    $_POST = [];
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Zainab Al Mansoor | Full Stack Web Developer Portfolio | Frontend & PHP Backend Expert</title>
    <meta name="title" content="Zainab Al Mansoor | Full Stack Web Developer Portfolio | Frontend & PHP Backend Expert">
    <meta name="description" content="Zainab Al Mansoor's Full Stack Web Development Portfolio. Specialized in Frontend (HTML, CSS, Tailwind) and PHP Backend development, including E-commerce solutions and custom web apps. Based in Karachi, Pakistan.">
    <meta name="keywords" content="Zainab Al Mansoor, Full Stack Developer, Web Developer, Frontend, PHP Developer, Laravel, MySQL, Ecommerce, Custom Web Apps, HTML CSS, Tailwind CSS, Portfolio, Karachi, Pakistan">
    <meta name="author" content="Zainab Al Mansoor">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <link rel="icon" type="image/png" href="img/fav.png">
</head>
<body class="font-poppins ">
<!-- ⭐NAVBAR -->  
    <nav class="w-full fixed top-0 left-0 z-50 bg-white/70 backdrop-blur-lg shadow">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-4 py-4">

            <a href="#" class="flex items-center gap-2 text-2xl font-bold text-[#46A0FA]">
                <i class="fa-solid fa-code text-[#4DA6FF]"></i>
                Zainab Portfolio
            </a>

            <button id="menuBtn" class="md:hidden text-3xl transition-all duration-200 text-[#4DA6FF]">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="hidden md:flex gap-10 font-semibold text-gray-700 text-lg">
                <li>
                    <a href="#home" class="hover:text-[#46A0FA] transition flex items-center gap-2">
                        <i class="fa-solid fa-house-chimney text-[#4DA6FF]"></i> Home
                    </a>
                </li>
                <li>
                    <a href="#about" class="hover:text-[#46A0FA] transition flex items-center gap-2">
                        <i class="fa-solid fa-user text-[#4DA6FF]"></i> About Me
                    </a>
                </li>
                <li>
                    <a href="#skills" class="hover:text-[#46A0FA] transition flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-[#4DA6FF]"></i> Skills
                    </a>
                </li>
                <li>
                    <a href="#education" class="hover:text-[#46A0FA] transition flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-[#4DA6FF] "></i> Education
                    </a>
                </li>
                <li>
                    <a href="#portfolio" class="hover:text-[#46A0FA] transition flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-[#4DA6FF]"></i> Portfolio
                    </a>
                </li>

                <li>
                    <a href="#contact" class="hover:text-[#46A0FA] transition flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-[#4DA6FF]"></i> Contact
                    </a>
                </li>
            </ul>

        </div>

        <ul id="mobileMenu"
            class="text-center absolute top-16 w-full bg-white shadow-xl flex flex-col text-lg font-semibold 
             transition-all duration-300 -translate-y-full opacity-0 pointer-events-none md:hidden z-40">

            <li class="border-b border-gray-100 py-3">
                <a href="#home" class="w-full hover:text-[#46A0FA] flex items-center justify-center gap-3 py-1 
           transition duration-200 hover:shadow-md hover:scale-[1.01] active:scale-[0.99] rounded-lg">
                    <i class="fa-solid fa-house-chimney text-[#4DA6FF] hover:text-blue-700"></i> Home
                </a>
            </li>

            <li class="border-b border-gray-100 py-3">
                <a href="#about" class="w-full hover:text-[#46A0FA] flex items-center justify-center gap-3 py-1
           transition duration-200 hover:shadow-md hover:scale-[1.01] active:scale-[0.99] rounded-lg">
                    <i class="fa-solid fa-user text-[#4DA6FF] hover:text-blue-700"></i> About Me
                </a>
            </li>

            <li class="border-b border-gray-100 py-3">
                <a href="#skills" class="w-full hover:text-[#46A0FA] flex items-center justify-center gap-3 py-1
           transition duration-200 hover:shadow-md hover:scale-[1.01] active:scale-[0.99] rounded-lg">
                    <i class="fa-solid fa-bolt text-[#4DA6FF] hover:text-blue-700"></i> Skills
                </a>
            </li>

            <li class="border-b border-gray-100 py-3">
                <a href="#education" class="w-full hover:text-[#46A0FA] flex items-center justify-center gap-3 py-1
           transition duration-200 hover:shadow-md hover:scale-[1.01] active:scale-[0.99] rounded-lg">
                    <i class="fa-solid fa-graduation-cap text-[#4DA6FF] hover:text-blue-700"></i> Education
                </a>
            </li>

            <li class="border-b border-gray-100 py-3">
                <a href="#portfolio" class="w-full hover:text-[#46A0FA] flex items-center justify-center gap-3 py-1
           transition duration-200 hover:shadow-md hover:scale-[1.01] active:scale-[0.99] rounded-lg">
                    <i class="fa-solid fa-briefcase text-[#4DA6FF] hover:text-blue-700"></i> Portfolio
                </a>
            </li>

            <li class="py-3">
                <a href="#contact" class="w-full hover:text-[#46A0FA] flex items-center justify-center gap-3 py-1
           transition duration-200 hover:shadow-md hover:scale-[1.01] active:scale-[0.99] rounded-lg">
                    <i class="fa-solid fa-envelope text-[#4DA6FF] hover:text-blue-700"></i> Contact
                </a>
            </li>

        </ul>
    </nav>
<!-- ⭐HERO -->
    <section id="home"
        class="w-full bg-gradient-to-br from-blue-50 to-blue-100 mt-10 pt-20  py-0 md:py-20 px-6 md:px-12 lg:px-20 flex flex-col lg:flex-row items-center justify-between">

        <div class="max-w-2xl z-10 text-center lg:text-left">

            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900">Hi, I'm</h1>

            <h1
                class="text-5xl sm:text-6xl font-extrabold mt-2 bg-gradient-to-r from-[#46A0FA] to-blue-600 text-transparent bg-clip-text">
                Zainab Al Mansoor
            </h1>

            <h2 class="text-2xl sm:text-3xl font-bold mt-4 text-gray-900">
                Full-Stack PHP Developer
                <span class="block text-[#46A0FA] text-xl sm:text-2xl font-semibold mt-1">
                    Frontend • Backend • Responsive Web Specialist
                </span>
            </h2>

            <p class="text-lg sm:text-xl mt-5 text-gray-700 leading-relaxed mx-auto lg:mx-0 max-w-xl">
                Full-Stack PHP Developer skilled in building responsive, user-friendly web apps with seamless frontend
                and
                backend integration.
            </p>

            <button class="mt-8 px-9 py-4 rounded-3xl bg-[#46A0FA] text-white font-semibold
      shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1
      transition-all duration-300">
                <a href="#portfolio"> View My Work</a>
            </button>
            <button class="mt-8 px-9 py-4 rounded-3xl text-[#46A0FA] font-semibold
  shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300
  hover:bg-blue-100 hover:-translate-y-1   border-2 border-blue-500 
  cursor-pointer transition-all duration-300">

                <a href="#contact">Let's talk</a>
            </button>

        </div>

        <div class="relative mt-14 lg:mt-0 flex items-center justify-center">

            <div class="rounded-full p-3 bg-white shadow-2xl border border-blue-200 float-rotate">
                <img src="img/zainabcodes.jpg"
                    class="w-[250px] sm:w-[300px] lg:w-[360px] h-auto rounded-full object-cover">
            </div>

        </div>

    </section>
<!-- ⭐ABOUT ME -->
    <section id="about" class="max-w-6xl mx-auto px-6 bg-white py-20">
        <div class="text-center mb-8">
            <h2 class="text-5xl font-extrabold text-gray-800">About <span class="text-[#46A0FA]">Me</span></h2>
            <div class="w-28 h-1 bg-blue-200 rounded-full mx-auto mt-4"></div>
            <p class="mt-4 text-gray-500">Get to know the person behind the code</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="flex justify-center ">
                <div class="p-10 rounded-2xl shadow-[0_30px_60px_rgba(2,6,23,0.08)] accent-bg">
                    <div class="w-80 h-80 rounded-xl relative group overflow-hidden bg-white shadow-lg">
                        <img src="img/zainabcodes.jpg" alt="about image"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:opacity-0" />
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-blue-600 text-white text-center px-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <p class="text-lg  font-semibold">

                                Hello! I'm a passionate developer crafting digital experiences.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-4xl text-center font-extrabold deep-blue">Crafting Digital Experiences</h3>
                <div class="w-20 h-1 bg-blue-200 rounded-full mx-auto mt-4 mb-6"></div>


                <p class="text-lg leading-8 text-gray-600">I am a passionate and dedicated aspiring web developer with
                    comprehensive training from the <b>ACCP AI Career Program</b> . My journey began with mastering office
                    productivity
                    tools, responsive web design, and version control, progressing to advanced skills in <b>PHP</b> ,
                    <b>MySQL</b> ,<b>JavaScript</b> ,
                    <b> XML/JSON</b>, and <b>Laravel</b> . I have experience in building dynamic, SEO-optimized websites and
                    full web applications
                    through hands-on projects.

                    I enjoy creating responsive, user-friendly websites and continuously enhancing my technical skills
                    to deliver
                    high-quality solutions. My goal is to contribute to innovative web development projects and grow as
                    a
                    proficient <b> Responsive Web Developer</b> and <b> PHP Developer</b>.</p>
            </div>
        </div>
    </section>
<!-- ⭐SKILLS -->
    <section id="skills" class="py-20 p-9 bg-white">
        <div class="max-w-7xl text-center mx-auto px-4">

            <h2 class="text-5xl font-extrabold text-gray-800">My <span class="text-[#46A0FA]">Skills</span></h2>
            <div class="w-28 h-1 bg-blue-200 rounded-full mx-auto   mt-4"></div>

            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 mt-5 lg:grid-cols-5 gap-8 sm:gap-10 lg:gap-12 justify-items-center">

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="100"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/html_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">100%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">HTML</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="92"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/css3_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">92%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">CSS3</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="90"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/tailwind_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">90%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">Tailwind CSS</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="95"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/bootstrap_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">95%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">Bootstrap 5</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="90"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/js_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">90%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">JavaScript</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="88"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/php-logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">88%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">PHP</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="85"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/mySql_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">85%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">MySQL</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="90"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/larvel_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">90%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">Laravel</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="80"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/jQuery_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">80%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">jQuery</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="90"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/seo_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">90%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">SEO</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="90"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/github_logo.jpg" class="w-14 h-14 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">90%</span>
                        </div>

                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-sky-600">GitHub</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="85"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/xml.jpg" class="w-12 h-12 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">85%</span>
                        </div>

                    </div>
                    <h3 class="text-sm sm:text-base md:text-lg font-bold text-sky-600">XML</h3>
                </div>

                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32">

                        <div class="absolute inset-0 rounded-full border-[6px] border-gray-400 opacity-80"></div>

                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="50%" cy="50%" r="46%" stroke="#0ea5e9" stroke-width="10" fill="none"
                                stroke-linecap="round" stroke-dasharray="289" stroke-dashoffset="289"
                                class="skill-circle" data-skill="85"></circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="img/json.jpg" class="w-12 h-12 rounded-full animate-spin-slow mb-1">
                            <span class="text-lg font-bold text-gray-700">85%</span>
                        </div>

                    </div>
                    <h3 class="text-sm sm:text-base md:text-lg font-bold text-sky-600">JSON</h3>
                </div>

            </div>

        </div>
    </section>
<!-- ⭐EDUCATION -->
    <div id='education' class="bg-[#F9FBFD]  p-8 sm:p-12">
        <div class="max-w-4xl mx-auto">

            <h2 class="mt-7 text-5xl text-center font-extrabold text-gray-800">Education & <span
                    class="text-[#46A0FA]">Milestones</span></h2>
            <div class="w-28 h-1 bg-blue-200 rounded-full mx-auto  mb-9 mt-4"></div>

            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-circle">S1</div>
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">
                            Certificate of Proficiency (Web Foundation)
                        </h3>
                        <p class="text-sm text-blue-600 font-medium mb-3">ACCP i! Career Program - Semester 1</p>
                        <p class="text-gray-700">
                            Completed foundational modules in <b>Responsive Web Development</b>  and <b> Office Automation</b>.
                        </p>
                        <ul class="list-disc list-inside text-sm text-gray-500 mt-3 ml-4">
                            <li><b>Core Skills:</b>  HTML, CSS, <b>Bootstrap</b>  (Responsive Design), <b>jQuery</b> 
                            , Distributed
                                Version Control (Git), SEO.</li>
                        </ul>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-circle">S2</div>
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">
                            Diploma in Information Systems Management
                        </h3>
                        <p class="text-sm text-blue-600 font-medium mb-3">ACCP i! Career Program - Semester 2</p>
                        <p class="text-gray-700">
                            Achieved a diploma by mastering <b>Dynamic Web Development</b>  and <b>Database Systems</b>, ready
                            for professional roles.
                        </p>
                        <ul class="list-disc list-inside text-sm text-gray-500 mt-3 ml-4">
                            <li> <b>Core Skills:</b> <b>PHP</b> , <b>Laravel Framework</b>, <b>MySQL</b> , <b>JavaScript</b>, CMS
                                Implementation, XML/JSON.</li>
                            <li><b>Job Profile Ready:</b> Responsive Web Developer, PHP Developer.</li>
                        </ul>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-circle bg-gray-400">S3</div>
                    <div class="timeline-content opacity-75 border-gray-300">
                        <h3 class="text-xl font-semibold text-gray-600 mb-1">
                            Pursuing: Higher Diploma in Software Engineering I (.NET)
                        </h3>
                        <p class="text-sm text-gray-500 font-medium mb-3">ACCP i! Career Program - Semester 3</p>
                        <p class="text-gray-500 italic">
                            Currently focusing on modern enterprise development using the Microsoft stack.
                        </p>
                        <ul class="list-disc list-inside text-sm text-gray-400 mt-3 ml-4">
                            <li>**Upcoming Focus:** ASP.NET CORE MVC, C#, SQL Server, TypeScript.</li>
                        </ul>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-circle bg-gray-400">S4</div>
                    <div class="timeline-content opacity-75 border-gray-300">
                        <h3 class="text-xl font-semibold text-gray-600 mb-1">
                            Upcoming: Higher Diploma in Software Engineering II (MERN)
                        </h3>
                        <p class="text-sm text-gray-500 font-medium mb-3">ACCP i! Career Program - Semester 4</p>
                        <p class="text-gray-500 italic">
                            Advanced Full-Stack development with the JavaScript/Node.js ecosystem.
                        </p>
                        <ul class="list-disc list-inside text-sm text-gray-400 mt-3 ml-4">
                            <li><b> Upcoming Focus:</b> <b>ReactJS</b>, <b>MongoDB</b>,<b>Node.js</b> 
                            , Express.js (ME(R)N Stack).
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="timeline-item ai-focus">
                    <div class="timeline-circle">AI</div>
                    <div class="timeline-content border-purple-300">
                        <h3 class="text-xl font-semibold text-purple-700 mb-1">
                            Future Goal: Advanced Diploma in Artificial Intelligence
                        </h3>
                        <p class="text-sm text-purple-600 font-medium mb-3">ACCP i! Career Program - Semesters 5 & 6</p>
                        <p class="text-gray-700">
                            <b>Long-term goal</b> is to specialize in <b>AI/ML</b>  and <b>Data Science</b> to build intelligent
                            systems.
                        </p>
                        <ul class="list-disc list-inside text-sm text-gray-500 mt-3 ml-4">
                            <li><b>Planned Focus:</b> <b>Python</b>, Data Science, NLP, Deep Learning, Dart/Flutter
                                (Cross-Platform).</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- ⭐PORTFOLIO -->  
<section id="portfolio" class="py-16 md:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-5xl text-center font-extrabold text-gray-800">My<span class="text-[#46A0FA]">Projects</span></h2>
            <div class="w-28 h-1 bg-blue-200 rounded-full mx-auto mb-9 mt-4"></div>
            <p class="text-gray-500 mt-2 text-md">Selected projects — handcrafted with performance and polish.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-8 px-4" data-aos="fade-up">
            <button
                class="filter-btn border-2 border-[#0ea5e9] px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300 bg-[#ffffff] text-[#0ea5e9] filter-active"
                data-filter="all">All</button>
            <button
                class="filter-btn border-2 border-[#0ea5e9] px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300 bg-[#ffffff] text-[#0ea5e9]"
                data-filter="web">Ecommerce</button>
            <button
                class="filter-btn border-2 border-[#0ea5e9] px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300 bg-[#ffffff] text-[#0ea5e9]"
                data-filter="frontend">Frontend</button>
            <button
                class="filter-btn border-2 border-[#0ea5e9] px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300 bg-[#ffffff] text-[#0ea5e9]"
                data-filter="backend">Backend</button>
        </div>

       

        <div class="relative">
            <button id="slideLeft"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-3 rounded-full text-white bg-[#0ea5e9] transition-all hover:bg-blue-600 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div id="slider"
                class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory px-4 md:px-0 py-4 scrollbar-hide">
                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="web">
                    <img src="img/ekart_project.png" alt="E-Kart" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">E-Kart Website</h3>
                        <p class="text-gray-300 mt-1 text-sm">Ecommerce</p>
                        <a href="https://zainab-al-mansoor.github.io/E-Kart/" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>

                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="frontend">
                    <img src="img/parkweb.png" alt="Merciado" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">Merciado Amusement Park</h3>
                        <p class="text-gray-300 mt-1 text-sm">Frontend</p>
                        <a href="https://zainab-al-mansoor.github.io/Merciado-Amusement-Park/" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>

                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="frontend">
                    <img src="img/cellinfo.png" alt="Cellinfo" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">Cellinfo</h3>
                        <p class="text-gray-300 mt-1 text-sm">Frontend</p>
                        <a href="https://qirat-al-mansoor.github.io/CELLINFO/index.html" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>

                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="frontend">
                    <img src="img/mainstreetdental.png" alt="Main Street Dental" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">Main Street Dental</h3>
                        <p class="text-gray-300 mt-1 text-sm">Frontend</p>
                        <a href="https://www.mainstreetdentaloffice.com/" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>

                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="frontend">
                    <img src="img/frsconstruction.png" alt="Frs Construction" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">Frs Construction</h3>
                        <p class="text-gray-300 mt-1 text-sm">Frontend</p>
                        <a href="https://frsconstruction.co.uk/" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>

                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="backend">
                    <img src="img/sirat_web backend.png" alt="Sirat Academy" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">Sirat Academy</h3>
                        <p class="text-gray-300 mt-1 text-sm">Backend</p>
                        <a href="https://www.siratacademy.com.pk/admission_form.php" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>

                <div
                    class="project-card group relative w-72 md:w-80 flex-shrink-0 snap-start rounded-xl overflow-hidden shadow-lg bg-gray-800 cursor-pointer transition-all duration-300 transform hover:scale-[1.02]"
                    data-category="backend">
                    <img src="img/care_web_backend.png" alt="Care" class="w-full h-52 object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center px-4">
                        <h3 class="text-white text-lg font-bold">Care</h3>
                        <p class="text-gray-300 mt-1 text-sm">Backend</p>
                        <a href="https://carehub.free.nf/" target="_blank"
                            class="mt-3 px-4 py-2 rounded-full bg-[#0ea5e9] text-white font-semibold transition-colors hover:bg-blue-600">View Project</a>
                    </div>
                </div>
            </div>

            <button id="slideRight"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-3 rounded-full text-white bg-[#0ea5e9] transition-all hover:bg-blue-600 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

    </div>
</section>
<!-- ⭐CONTACT -->  
<div class="con" id="contact">

    <div class="max-w-7xl mx-auto py-16 px-6 md:px-12 text-center fade-up">
        
         <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-5xl text-center font-extrabold text-gray-800">Get <span class="text-[#46A0FA]">in touch</span></h2>
            <div class="w-28 h-1 bg-blue-200 rounded-full mx-auto mb-9 mt-4"></div>
        </div>

        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Ready to collaborate? Let's discuss your next project and bring your ideas to life.
        </p>
    </div>

    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 px-6 md:px-12 pb-16">

        <div class="bg-white p-10 rounded-2xl shadow-2xl border border-gray-100 fade-up">

            <form method="POST" class="space-y-6">

                <div class="flex flex-col">
                    <label for="name" class="mb-2 font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" placeholder="Your Name"
                        value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
                        class="w-full border border-gray-300 p-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm hover:shadow-md transition">
                    <?php if ($errors["name"]): ?>
                        <p class="text-red-500 text-sm mt-2"><?= $errors["name"] ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col">
                    <label for="email" class="mb-2 font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="Your Email"
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                        class="w-full border border-gray-300 p-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm hover:shadow-md transition">
                    <?php if ($errors["email"]): ?>
                        <p class="text-red-500 text-sm mt-2"><?= $errors["email"] ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col">
                    <label for="subject" class="mb-2 font-medium text-gray-700">Subject</label>
                    <input type="text" name="subject" id="subject" placeholder="Subject"
                        value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '' ?>"
                        class="w-full border border-gray-300 p-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm hover:shadow-md transition">
                    <?php if ($errors["subject"]): ?>
                        <p class="text-red-500 text-sm mt-2"><?= $errors["subject"] ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col">
                    <label for="message" class="mb-2 font-medium text-gray-700">Message</label>
                    <textarea name="message" id="message" rows="6" placeholder="Your Message"
                        class="w-full border border-gray-300 p-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm hover:shadow-md transition"><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ?></textarea>
                    <?php if ($errors["message"]): ?>
                        <p class="text-red-500 text-sm mt-2"><?= $errors["message"] ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" name="submit"
                    class="bg-gradient-to-r from-[#4DA6FF] to-[#1E90FF]
                        text-white px-6 py-3 rounded-xl w-full flex items-center justify-center gap-3 shadow-lg
                        transition-all duration-300 hover:scale-105 hover:-translate-y-1 animate-pulse-soft group">
                    Send Message <i class="fas fa-paper-plane group-hover:translate-x-1"></i>
                </button>

            </form>

        </div>


        <div class="bg-white p-10 rounded-2xl shadow-2xl border border-blue-100 fade-up">
            <h3 class="text-2xl font-semibold text-[#4DA6FF] mb-8">Contact Information</h3>
            <div class="space-y-8">

                <div class="flex items-start gap-4 group">
                    <div class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF] p-4 rounded-full">
                        <a target='_blank' href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com">
                            <i class="fas fa-envelope text-[#4DA6FF] text-xl"></i>
                        </a>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Email</p>
                        <a target='_blank' href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com">
                            <p class="text-gray-500 text-sm">zainabalmansoor2024@gmail.com</p>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 group">
                    <div class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF] p-4 rounded-full">
                        <a href="https://wa.me/923289212815">
                            <i class="fas fa-phone text-[#4DA6FF] text-xl"></i>
                        </a>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Phone</p>
                        <a href="https://wa.me/923289212815">
                            <p class="text-gray-500 text-sm">+92-328-9212815</p>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 group">
                    <div class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF] p-4 rounded-full"><i class="fas fa-map-marker-alt text-[#4DA6FF] text-xl"></i></div>
                    <div><p class="font-medium text-gray-700">Location</p><p class="text-gray-500 text-sm">Karachi, Pakistan</p></div>
                </div>
                <div class="flex gap-4 mt-6">
                    <a href="https://github.com/Zainab-Al-Mansoor" target='_blank'
                    class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF] p-4
                    rounded-full text-[#1E90FF] shadow-md transition transform
                    hover:scale-110 hover:-translate-y-1">
                        <i class="fab fa-github"></i>
                    </a>

                    <a href="https://www.linkedin.com/in/zainab-al-mansoor-a37bb631a/" target='_blank' class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF] p-4 rounded-full
                    text-[#1E90FF] shadow-md transition transform hover:scale-110 hover:-translate-y-1">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                    <a href="https://wa.me/923289212815" target='_blank' class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF]
                        p-4 rounded-full text-[#1E90FF] shadow-md transition transform
                        hover:scale-110 hover:-translate-y-1"><i class="fab fa-whatsapp">
                        </i>
                    </a>

                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com"
                    target='_blank'
                    class="bg-gradient-to-br from-[#E8F3FF] to-[#D6EAFF] p-4
                            rounded-full text-[#1E90FF] shadow-md transition transform
                            hover:scale-110 hover:-translate-y-1">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

            </div>
        </div>

    </div>

    <script>
        // contact form js
        document.addEventListener("DOMContentLoaded", function () {
            const elements = document.querySelectorAll(".fade-up");
            const observer = new IntersectionObserver((entries)=>{
                entries.forEach((entry)=>{ if(entry.isIntersecting) entry.target.classList.add("visible"); });
            }, { threshold:0.2 });
            elements.forEach((el)=>observer.observe(el));

            <?php if ($showModal): ?>
                document.getElementById("successModal").classList.remove("hidden");
            <?php endif; ?>
        });
    </script>

</div>
<!-- ⭐FOOTER -->  
<footer class="bg-[#1e1e3f] text-white py-14 px-6 lg:px-24 relative overflow-hidden">

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12 items-start fade-up">

        <div class="space-y-5 flex flex-col items-center lg:items-start">
            <div class="text-3xl font-extrabold leading-tight flex flex-col items-center lg:items-start gap-2 animate-float">
                <span class="neon-icon text-5xl">&lt;/&gt;</span>

                <div class="flex flex-col leading-tight items-center lg:items-start">
                    <div class="neon-outline">DEVELOPER</div>
                    <div class="neon-outline">PORTFOLIO</div>
                </div>

            </div>

            <p class="text-gray-300 text-center lg:text-left max-w-sm">
                Crafting digital <span class="text-blue-400">experiences</span> that inspire and stand out.
            </p>

            <div class="mt-2 mx-auto lg:mx-0">
                <svg width="140" height="18" viewBox="0 0 140 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 9
                        C 20 2, 30 16, 50 9
                        S 80 2, 100 9
                        S 130 16, 140 9" stroke="#3b82f6" stroke-width="1" stroke-linecap="round" />
                </svg>
            </div>

        </div>

        <div class="space-y-6 fade-up text-center lg:text-left" style="animation-delay:0.2s;">
            <div class="inline-block mx-auto lg:mx-0">
                <h3 class="text-white text-lg font-semibold border-b-2 border-blue-500 pb-1 inline-block">Explore</h3>
                <ul class="space-y-2 text-gray-300 mt-2">
                    <li class="hover:text-blue-400 transition"><a href="index.html">Home</a></li>
                    <li class="hover:text-blue-400 transition"><a href="#about">About Me</a></li>
                    <li class="hover:text-blue-400 transition"><a href="#skills">Skills</a></li>
                    <li class="hover:text-blue-400 transition"> <a href="#education">Education</a></li>
                    <li class="hover:text-blue-400 transition"><a href="#portfolio">Portfolio</a></li>
                    <li class="hover:text-blue-400 transition"><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="inline-block mx-auto lg:mx-0 mt-8">
                <h3 class="text-white text-lg font-semibold border-b-2 border-blue-500 pb-1 inline-block">Connect</h3>
                <ul class="space-y-2 text-gray-300 mt-2">

                    <li class="flex items-center gap-3 hover:text-blue-400 transition cursor-pointer justify-center lg:justify-start">
                        <a target='_blank' href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com">
                            <i class="fa-solid fa-envelope text-blue-400"></i> Email
                        </a>
                    </li>

                    <li class="flex items-center gap-3 hover:text-blue-400 transition cursor-pointer justify-center lg:justify-start">
                        <a href="https://wa.me/923289212815" target='_blank'>
                            <i class="fa-solid fa-phone text-blue-400"></i> Call
                        </a>
                    </li>

                    <li class="flex items-center gap-3 hover:text-blue-400 transition cursor-pointer justify-center lg:justify-start">
                        <i class="fa-solid fa-location-dot text-blue-400"></i> Location
                    </li>

                </ul>
            </div>

        </div>

        <div class="space-y-5 fade-up flex flex-col items-center lg:items-start" style="animation-delay:0.4s;">
            <h3 class="text-white text-lg font-semibold text-center lg:text-left">Let's Connect</h3>

            <div class="flex gap-4 mx-auto lg:mx-0">
                <a href="https://github.com/Zainab-Al-Mansoor" target="_blank"
                    class="bg-[#2a2a5c] p-3 rounded-full transition-all icon-float">
                    <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" class="w-5 h-5" />
                </a>
                <a href="https://www.linkedin.com/in/zainab-al-mansoor-a37bb631a/" target="_blank"
                    class="bg-[#2a2a5c] p-3 rounded-full transition-all icon-float">
                    <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" class="w-5 h-5" />
                </a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com"
                    class="bg-[#2a2a5c] p-3 rounded-full transition-all icon-float">
                    <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" class="w-5 h-5" />
                </a>
                <a href="https://wa.me/923289212815" target="_blank"
                    class="bg-[#2a2a5c] p-3 rounded-full transition-all icon-float">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" class="w-5 h-5" />
                </a>
            </div>

            <p class="text-gray-300 leading-relaxed text-center lg:text-left">
                Ready to collaborate on your next project?
                <br>Let’s turn your ideas into reality!
            </p>

            <div class="space-y-2 text-gray-300 flex flex-col items-center lg:items-start w-full">
                <p class="flex items-center gap-3 justify-center lg:justify-start">
                    <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com">
                        <i class="fa-solid fa-envelope text-blue-400"></i>
                    </a>
                    <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=zainabalamansoor2024@gmail.com">
                        zainabalamansoor2024@gmail.com
                    </a>
                </p>

                <p class="flex items-center gap-3 justify-center lg:justify-start">
                    <a target="_blank" href="https://wa.me/923289212815">
                        <i class="fa-solid fa-phone text-blue-400"></i>
                    </a>
                    <a target="_blank" href="https://wa.me/923289212815">
                        +92 328 921 2815
                    </a>
                </p>

                <p class="flex items-center gap-3 justify-center lg:justify-start">
                    <i class="fa-solid fa-location-dot text-blue-400"></i>
                    Karachi, Pakistan
                </p>

            </div>


            <button
                class="mt-4 px-4 py-2 bg-[#2a2a5c] rounded-full flex items-center gap-2 text-gray-300 hover:bg-blue-500 transition-all icon-float mx-auto lg:mx-0">
                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                Available for freelance projects
            </button>
        </div>

    </div>

    <p class="text-gray-400 text-sm text-center mt-12 fade-up" style="animation-delay:0.6s;">
        &copy; 2025 All Rights Reserved • Zainab Al Mansoor
    </p>

</footer>

<!-- ⭐CONTACT BUTTON -->  
<button aria-hidden
    class="fixed left-8 bottom-8 w-14 h-14 rounded-full bg-blue-500 shadow-lg flex items-center justify-center text-white z-50">
    <a href="#contact">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8-1.4 0-2.73-.25-3.96-.7L3 20l1.7-4.04C4.26 14.73 4 13.4 4 12c0-4.418 4.03-8 9-8s8 3.582 8 8z" />
        </svg>
    </a>
</button>
<!-- ⭐ARROW BUTTON -->  
<button aria-hidden
    class="fixed right-8 bottom-8 w-14 h-14 rounded-full bg-blue-500 shadow-lg flex items-center justify-center text-white z-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7 7 7M5 20l7-7 7 7" />
    </svg>
</button>



<style>
     .filter-active {
                background-color: #0ea5e9;
                color: #ffffff;
                border-color: #0ea5e9 !important; 
            }
            .scrollbar-hide {
                -ms-overflow-style: none; 
                scrollbar-width: none; 
            }
            .scrollbar-hide::-webkit-scrollbar {
                display: none; 
            }
</style>
<script src="script.js"></script>
</body>

</html>