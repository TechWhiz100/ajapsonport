<?php

 include 'config.php';


 $query = "SELECT * FROM projects";
 $stmt = $conn->prepare($query);
 $stmt->execute();
 $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajapson</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>
    
        <a href="#" class="logo"> <span>Aja</span>Pson </a>
        
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About Me</a>
            <a href="#experience">Experience</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
        </nav>

        <div id="login-btn">
            <i class="fas fa-seedling"></i>
        </div>
    </header> 
    <section class="home" id="home">
        <div class="text-container">
            <h3 data-speed="-2" class="home-parallax">Welcome to</h3>
            <a data-speed="7" href="#" class="home-parallax-1">Osen Ajape Data Analysis Portfolio</a>
            <p>Research Executive</p>
        </div>
        <div class="image-container">
            <img data-speed="5" class="home-parallax" src="images/pics.jpg" alt="">
        </div>
    </section>

    <section class="about" id="about">
        <h3 class="heading">About <span>Me</span></h3>
        <p>Former research executive at kantar Nigeria. I have a deep love for data because it keeps us informed about what's happening around us and replaces assumptions with solid convincing facts.</p>
        <p>I am deeply committed to creating value, believing that the more value you provide, the more opportunities arise, an insight I’ve experienced firsthand. My inquisitive nature has significantly contributed to my personal growth. I constantly ask questions, anticipate potential issues in tasks and projects, and try to maintain control and oversight. One of my strongest attributes is critical thinking.</p>
        <p>My passion for this field was sparked by watching my two brothers succeed in their roles as a Marketing Manager and a Data Quality Lead. Their impactful work in solving business problems and clarifying uncertainties with data has been a significant inspiration for me, and their support in my career journey.</p>
        <a href="index.html" class="btn">discover our services</a>
    </section>

    <section class="experience" id="experience">
        <h3 class="heading">My <span>Experience</span></h3>
        <p>I earned my degree in Mechanical Engineering and am currently studying for my postgraduate studies in Data Analysis for business decision-making and Artificial Intelligence.</p>
        <p>My career began as a Research Trainee at Grandlaunch Training Institute in Lagos, Nigeria, where I gained foundational experience in research and data analysis. I then advanced to a role as a Research Executive Trainee at Kantar Nigeria, working with large volumes of real-world data. I was subsequently promoted to Research Executive at Kantar Nigeria, where I worked for a few months before focusing on my current educational pursuits.</p>
        <p>Some of my career accomplishments include assisting a client in evaluating the success of a newly launched product, creating dashboards for brand performance monitoring and data visualization, and developing Excel macros to ensure data quality checks.</p>
        <a href="index.html" class="btn">discover our services</a>
    </section>

    <section class="skills" id="skills">
        <h3 class="heading">My <span>Skills</span></h3>
        <div class="image-container">
            <img src="images/a3c153_3592f141741849e8b2cb99afa8e3a412~mv2 (1).webp" alt="">
            <div class="text-overlay">
                <ul>
                    <p>My key skills encompass:</p>
                    <li>1. Programing Languages: SQL Server, PostgreSQL, My SQL  | Python, Jupiter Notebook</li>
                    <li>2. Visualization Tools: Power BI   | Tableau    |  Excel</li>
                    <li>3. Statistical Tools:  Excel   | Power View.</li>
                    <li>4. Team Work</li>
                    <li>5. Critical Thinking</li>
                    <li>6. Communication</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- <section class="career" id="career">
        <h3 class="heading">Career <span>Timeline</span></h3>
        <h2 class="sub">Career Break Statement for Professional and Career Development</h2>
        <p>I am currently on a career break to strategically enhance my professional development. To meet the evolving demands of the industry and advance to senior roles, I began a graduate program in Data Analysis for Business Decision Making and Artificial Intelligence in January 2024. This program deepens my knowledge and expands my expertise in data analysis, business decision-making, and AI.</p>
        <p>This career break underscores my commitment to growth and excellence in a competitive job market. By August 2025, equipping me with cutting-edge skills to contribute at a senior level, bringing advanced analytical capabilities and a robust understanding of data-driven decision-making.</p>
        <p>My career aspiration is to reach the peak of my field, leveraging my skills in environments where I can continue to learn and grow. I seek roles that offer challenging opportunities, particularly those involving big data and innovative tools. I enjoy tackling complex problems and finding new, efficient ways to achieve results, fueling my passion for critical thinking and personal development.</p>
        <p>I look forward to discussing how my enhanced qualifications can contribute to your organization’s success.</p>
    
    </section> -->

    <section class="projects" id="projects">
        <h3 class="heading">My <span>Projects</span></h3>
        <div class="box-container">
            <?php foreach ($projects as $project): ?>
            <div class="box">
                <img src="uploaded_images/<?php echo htmlspecialchars($project['image_filename']); ?>" alt="">
                <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                <p><?php echo htmlspecialchars($project['description']); ?></p>
                <a href="projects?id=<?php echo $project['id']; ?>" class="btn">View Project</a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="contact" id="contact">
        <h3 class="heading">Contact <span>Me</span></h3>
        <div class="share">
            <a href="mailto:ajapeosen@gmail.com?subject=Hello%20Osen" class="fas fa-envelope"></a>
            <a href="https://api.whatsapp.com/send/?phone=13656622564&text=Hello%20Ajape%20Osen&app_absent=0" target="_blank" class="fab fa-whatsapp"></a>
            <a href="https://www.linkedin.com/in/osen-ajape-b094a916a/overlay/about-this-profile/?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base%3B7CUI%2FAsYQMO4bX1NebomfA%3D%3D" target="_blank" class="fab fa-linkedin"></a>
            <div class="phone">
                <a href="#" class="fas fa-phone">
                    <p style="margin-left: -5rem;">+1(365)6622564</p></a>
                <!-- <i class="fas fa-phone"></i> -->
                <!-- <a href="#" class="fas fa-phone"></a> -->
            </div>
           
        </div>
    </section>


    <section class="footer">
        <div class="credit">
            &copy; developed by <span>Tech Whiz</span>
         </div>

    </section>
    
   
    
    


     <script src="js/script.js"></script>   
</body>
</html>