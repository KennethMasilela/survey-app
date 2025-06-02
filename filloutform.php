<?php
// Start session to optionally store messages (not used in this version)
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lifestyle Survey</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="survey-wrapper">
    <header>
      <h2>_Surveys</h2>
      <nav>
        <a href="filloutform.php" class="active">FILL OUT SURVEY</a>
        <a href="results.php">VIEW SURVEY RESULTS</a>
      </nav>
    </header>

    <form id="survey-form" method="POST" class="survey-form">

      <!-- Personal Details -->
      <div class="form-section personal-details-section">
        <label class="section-title">Personal Details :</label>
        <div class="personal-inputs">
          <label>Full Names:</label>
          <input type="text" name="name" required>

          <label>Email:</label>
          <input type="email" name="email" required>

          <label>Date of Birth:</label>
          <input type="date" name="date" required>

          <label>Contact Number:</label>
          <input type="text" name="contact" required>
        </div>
      </div>

      <!-- Favorite Food Checkboxes -->
      <div class="form-section lifestyle-section">
        <label class="section-title">What is your favorite food? :</label>
        <div class="checkbox-row">
          <label class="custom-checkbox">
            <input type="checkbox" name="food[]" value="Pizza">
            <span class="checkmark"></span> Pizza
          </label>

          <label class="custom-checkbox">
            <input type="checkbox" name="food[]" value="Pasta">
            <span class="checkmark"></span> Pasta
          </label>

          <label class="custom-checkbox">
            <input type="checkbox" name="food[]" value="Pap and Wors">
            <span class="checkmark"></span> Pap and Wors
          </label>

          <label class="custom-checkbox">
            <input type="checkbox" name="food[]" value="Other">
            <span class="checkmark"></span> Other
          </label>
        </div>
      </div>

      <!-- Rating Table -->
      <div class="form-section">
        <label>
          Please rate your level of agreement on a scale from 1 to 5, with 1 being "strongly agree" and 5 being "strongly disagree."
        </label>

        <table>
          <colgroup>
            <col style="width: 25%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
          </colgroup>
          <thead>
            <tr>
              <th></th>
              <th>Strongly Agree</th>
              <th>Agree</th>
              <th>Neutral</th>
              <th>Disagree</th>
              <th>Strongly Disagree</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $questions = [
                "I like to watch movies" => "watch_movies",
                "I like to listen to radio" => "listen_radio",
                "I like to eat out" => "eat_out",
                "I like to watch TV" => "watch_tv"
              ];
              foreach ($questions as $label => $name): ?>
                <tr>
                  <td><?= $label ?></td>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <td>
                      <label class="custom-radio">
                        <input type="radio" name="<?= $name ?>" value="<?= $i ?>" required>
                        <span class="radio-mark"></span>
                      </label>
                    </td>
                  <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Submit Button -->
      <div class="submit-button">
        <input type="submit" value="SUBMIT">
      </div>

      <!-- Success/Error Message -->
      <div id="form-message" style="text-align: center; font-weight: bold; margin-top: 15px;"></div>

    </form>
  </div>

  <script>
    document.getElementById("survey-form").addEventListener("submit", function (e) {
      e.preventDefault();
      const form = this;
      const formData = new FormData(form);
      const messageBox = document.getElementById("form-message");

      fetch("process_form.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        messageBox.textContent = data.message;
        messageBox.style.color = data.success ? "green" : "red";
        if (data.success) form.reset();
        setTimeout(() => {
          messageBox.textContent = "";
        }, 3000);
      })
      .catch(err => {
        messageBox.textContent = "Something went wrong.";
        messageBox.style.color = "red";
        setTimeout(() => {
          messageBox.textContent = "";
        }, 3000);
      });
    });
  </script>

</body>
</html>
