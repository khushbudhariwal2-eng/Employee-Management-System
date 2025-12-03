<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Dashboard</title>
  <style>
   
body {
  margin: 0;
  
  background: #0f0f0f;
  color: #fff;
}

.dashboard {
  padding: 20px;
}


header {
  text-align: center;
  margin-bottom: 20px;
}
header h2 {
  font-weight: 400;
}
header span {
  color: #c8ff00;
}


.task-summary {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 15px;
  margin-bottom: 20px;
}

.task-summary .card {
  background: #1c1c1c;
  padding: 20px;
  border-radius: 12px;
  text-align: center;
}

.task-summary .card.total {
  background: #c8ff00;
  color: #000;
}
.task-summary h2, .task-summary h1 {
  margin: 0;
}
.task-summary span {
  font-size: 12px;
  color: #aaa;
}


.chart {
    background: #1c1c1c;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    width: 33%;
}
.chart-header {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
}
.chart-header button {
  background: none;
  border: 1px solid #444;
  padding: 5px 15px;
  border-radius: 20px;
  color: #fff;
  cursor: pointer;
}
.chart-header button.active {
  background: #c8ff00;
  color: #000;
}
.chart-body {
  display: flex;
  justify-content: space-between;
 
  height: 200px;
}
section.chart1 {
    display: flex;
    gap: 20px;
}
.bar-group {
  text-align: center;
}
.bar {
  width: 12px;
  border-radius: 5px;
  margin: 0 auto 5px;
}
.bar.work {
  background: #c8ff00;
}
.bar.due {
  background: #fff;
}


.timeline {
  background: #1c1c1c;
  padding: 20px;
  border-radius: 12px;
  margin-bottom: 20px;
}
.filters {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
}
.filters button {
  background: none;
  border: 1px solid #444;
  padding: 5px 12px;
  border-radius: 20px;
  color: #fff;
  cursor: pointer;
}
.filters button.active {
  background: #c8ff00;
  color: #000;
}
.timeline-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 10px;
}
.day h4 {
  margin-bottom: 8px;
  font-size: 14px;
  color: #c8ff00;
}
.task {
  padding: 8px 12px;
  border-radius: 20px;
  display: inline-block;
  font-size: 14px;
}
.task.yellow {
    background: #c8ff00;
    color: #000;
    margin-top: 40px;
}
.task.yellow1 {
    background: #c8ff00;
    color: #000;
    margin-top: 70px;
}
.task.white {
  background: #fff;
  color: #000;
}


.team {
  background: #1c1c1c;
  padding: 20px;
  border-radius: 12px;
}
.team .avatars img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid #0f0f0f;
  margin-right: -10px;
}

  </style>
</head>
<body>
  <div class="dashboard">

  
    <header>
      <h2>Welcome to Pro Workspace</h2>
    </header>

    
    <section class="task-summary">
      <div class="card total">
        <h1>50+</h1>
        <p>Totals Task</p>
      </div>
      <div class="card">
        <h2>12</h2>
        <p>Completed Task</p>
        <span>+1 this week</span>
      </div>
      <div class="card">
        <h2>3</h2>
        <p>Overdue Task</p>
        <span>+1 this week</span>
      </div>
      <div class="card">
        <h2>5</h2>
        <p>To Do Task</p>
        <span>+1 this week</span>
      </div>
    </section>

   <section class="chart1">
    <section class="chart">
      <div class="chart-header">
        <button class="active">Working Time</button>
        <button>Due Time</button>
      </div>
      <div class="chart-body">
        <div class="bar-group">
          <div class="bar work" style="height:60%"></div>
          
          <span>Mon</span>
        </div>
        <div class="bar-group">
          <div class="bar work" style="height:80%"></div>
         
          <span>Tue</span>
        </div>
        <div class="bar-group">
          <div class="bar work" style="height:70%"></div>
         
          <span>Wed</span>
        </div>
        <div class="bar-group">
          <div class="bar work" style="height:50%"></div>
         
          <span>Thu</span>
        </div>
        <div class="bar-group">
          <div class="bar work" style="height:90%"></div>
        
          <span>Fri</span>
        </div>
        <div class="bar-group">
          <div class="bar work" style="height:65%"></div>
         
          <span>Sat</span>
        </div>
        <div class="bar-group">
          <div class="bar work" style="height:55%"></div>
         
          <span>Sun</span>
        </div>
      </div>
    </section>

    
    <section class="timeline">
      <div class="filters">
        <button class="active">Everything</button>
        <button>Project Timeline</button>
        <button>Active</button>
        <button>Closed</button>
        <button>Filter</button>
      </div>
      <div class="timeline-grid">
        <div class="day">
          <h4>Sunday</h4>
          <div class="task white">Branding Design</div>
        </div>
        <div class="day">
          <h4>Tuesday</h4>
          <div class="task yellow">Web Design </div>
        </div>
        <div class="day">
          <h4>Thursday</h4>
          <div class="task yellow1">Web Develop</div>
        </div>
        <div class="day">
          <h4>Friday</h4>
          <div class="task white">Mobile App </div>
        </div>
        <div class="day">
          <h4>Saturday</h4>
          <div class="task yellow">Marketing Strategy</div>
        </div>
      </div>
    </section>
	</section>

   
    <section class="team">
      <h3>Team Members</h3>
      <div class="avatars">
        <img src="https://i.pravatar.cc/40?img=1" alt="">
        <img src="https://i.pravatar.cc/40?img=2" alt="">
        <img src="https://i.pravatar.cc/40?img=3" alt="">
        <img src="https://i.pravatar.cc/40?img=4" alt="">
        <img src="https://i.pravatar.cc/40?img=5" alt="">
      </div>
    </section>

  </div>
</body>
</html>
