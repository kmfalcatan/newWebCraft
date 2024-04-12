<style>
body {
  background-color: #f4f4f4;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  line-height: 1.6;
}

.container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

h1 {
  text-align: center;
  margin-bottom: 40px;
  color: #007bff; /* Blue shade for headings */
  font-weight: 300;
}

.unit-info {
  display: flex;
  align-items: center;
  margin-bottom: 40px;
}

.unit-info img {
  width: 200px;
  margin-right: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,.1);
}

.details ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.details li {
  margin-bottom: 10px;
  padding-left: 16px;
  position: relative;
}

.details li strong {
  color: #007bff; /* Matching blue for key details */
}

.details li::before {
  content: '';
  background-color: #007bff;
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.section {
  margin-top: 50px;
  border-top: 2px solid #eee;
  padding-top: 20px;
}

.section h2 {
  margin-bottom: 20px;
  font-size: 1.2rem;
  color: #333;
  font-weight: 400;
}

.user-details ul, .history ol {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.user-details li, .history li {
  margin-bottom: 10px;
  padding-left: 16px;
  position: relative;
}

.user-details li strong, .history li strong {
  color: #0056b3; /* Slightly darker blue for emphasis */
}

.user-details li::before, .history li::before {
  content: '';
  background-color: #007bff;
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.history ol {
  counter-reset: list;
}

.history li {
  list-style-type: none;
  margin-bottom: 10px;
  counter-increment: list;
}

.history li::before {
  content: counter(list) ". ";
  color: #007bff;
  font-weight: bold;
  margin-right: 5px;
}

</style>


<!DOCTYPE html>
<html>
<head>
  <title>Unit Tracker</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Unit Tracker</h1>

    <div class="unit-info">
      <img src="[Image URL]" alt="Unit Image">
      <div class="details">
        <ul>
          <li><strong>Unit ID:</strong> [Unit ID]</li>
          <li><strong>Name:</strong> [Unit Name]</li>
          <li><strong>Property Number:</strong> [Property Number]</li>
          <li><strong>Account Code:</strong> [Account Code]</li>
          <li><strong>Year Released:</strong> [Year Released]</li>
          <li><strong>Warranty Unit Value:</strong> [Warranty Unit Value]</li>
          <li><strong>Remarks:</strong> [Remarks]</li>
        </ul>
      </div>
    </div>

    <div class="section">
      <h2>Current End User</h2>
      <div class="user-details">
        <ul>
          <li><strong>First Name:</strong> [First Name]</li>
          <li><strong>Last Name:</strong> [Last Name]</li>
          <li><strong>Email:</strong> [Email]</li>
          <li><strong>Designation:</strong> [Designation]</li>
          <li><strong>Year Started:</strong> [Year Started]</li>
        </ul>
      </div>
    </div>

    <div class="section">
      <h2>Old User</h2>
      <div class="user-details">
        <ul>
          <li><strong>First Name:</strong> [Old User First Name]</li>
          <li><strong>Last Name:</strong> [Old User Last Name]</li>
          <li><strong>Email:</strong> [Old User Email]</li>
          <li><strong>Designation:</strong> [Old User Designation]</li>
          <li><strong>Year Started:</strong> [Old User Year Started]</li>
        </ul>
      </div>
    </div>

    <div class="section">
      <h2>Unit History</h2>
      <div class="history">
        <ol>
          <li>[Date]: Unit transferred from [Old User Name] to [Current User Name].</li>
          <li>[Date]: Unit removed from list. Reason: [Reason for Removal]. Retrieved by [Name].</li>
        </ol>
      </div>
    </div>
  </div>
</body>
</html>