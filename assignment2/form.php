<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="insert.php">
  Name :
  <input type="text" name="name" size="40" required>
  <br>
  Email :
  <input type="text" name="email" size="25" required>
  <br>
  How did you find me?
  <select name="find">
    <option selected disabled>Select</option>
    <option value="From a friend" required>From a friend</option>
    <option value="I googled you" required>I googled you</option>
    <option value="Just surf on in" required>Just surf on in</option>
    <option value="From your Facebook" required>From your Facebook</option>
    <option value="I clicked an ads" required>I clicked an ads</option>
  </select>
  <br>
  I like your:<br>
  <input type="checkbox" id="front-page" name="like_fp" value="Front page">Front page<br>
  <input type="checkbox" id="form" name="like_form" value="Form">Form<br>
  <input type="checkbox" id="ui" name="like_ui" value="User Interface">User Interface<br>
  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required></textarea>
  <br>
  <input type="submit" name="add_form" value="Add a New Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>