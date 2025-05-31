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

    <form action="process_form.php" method="POST" class="survey-form">

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
            <col style="width: 25%;">  <!-- 1st column: Question -->
            <col style="width: 15%;">  <!-- 2nd column -->
            <col style="width: 15%;">  <!-- 3rd column (same as 2nd) -->
            <col style="width: 15%;">  <!-- 4th column (same as 2nd) -->
            <col style="width: 15%;">  <!-- 5th column -->
            <col style="width: 15%;">  <!-- 6th column -->
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

    </form>
  </div>

</body>
</html>
