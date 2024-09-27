<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 300px; height: 100vh;">
    <ul class="nav nav-pills flex-column mb-auto dashboard-menu" id="sidebarMenu">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link" id="manageDashboard" onclick="setActive(this)">
                <i class="fas fa-users"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_users.php" class="nav-link" id="manageUsers" onclick="setActive(this)">
                <i class="fas fa-users"></i> Manage Users
            </a>
        </li>
        <li>
            <a href="manage_categories.php" class="nav-link" id="manageCategories" onclick="setActive(this)">
                <i class="fas fa-list-alt"></i> Manage Categories
            </a>
        </li>
        <li>
            <a href="manage_questions.php" class="nav-link" id="manageQuestions" onclick="setActive(this)">
                <i class="fas fa-question-circle"></i> Manage Questions
            </a>
        </li>
        <li>
            <a href="manage_answers.php" class="nav-link" id="manageAnswers" onclick="setActive(this)">
                <i class="fas fa-question-circle"></i> Manage Answers
            </a>
        </li>
        <li>
            <a href="manage_videos.php" class="nav-link" id="manageVideos" onclick="setActive(this)">
                <i class="fas fa-video"></i> Manage Videos
            </a>
        </li>
        <li>
            <a href="view_performance.php" class="nav-link" id="viewPerformance" onclick="setActive(this)">
                <i class="fas fa-chart-line"></i> View Performance
            </a>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Check for stored active link in local storage
        const activeLinkId = localStorage.getItem('activeLink');
        if (activeLinkId) {
            const activeLink = document.getElementById(activeLinkId);
            if (activeLink) {
                setActive(activeLink);
            }
        }
    });

    function setActive(link) {
        // Remove 'active' class from all links
        var links = document.querySelectorAll('.nav-link');
        links.forEach(function (item) {
            item.classList.remove('active');
        });

        // Add 'active' class to the clicked link
        link.classList.add('active');

        // Store the active link ID in local storage
        localStorage.setItem('activeLink', link.id);
    }
</script>