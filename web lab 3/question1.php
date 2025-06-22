<?php
$principal = $rate = $time = 0;
$simpleInterest = $compoundInterest = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $principal = floatval($_POST['principal']);
    $rate = floatval($_POST['rate']);
    $time = floatval($_POST['time']);

    $simpleInterest = ($principal * $rate * $time) / 100;
    $compoundInterest = $principal * pow((1 + $rate / 100), $time) - $principal;
}
?>
<!DOCTYPE html>
<html>
<head><title>Interest Calculator</title></head>
<body>
<h2>simple Interest </h2>
<form method="post">
    Principal: <input type="number" name="principal" step="0.01" required value="<?= $principal ?>"><br><br>
    Rate : <input type="number" name="rate" step="0.01" required value="<?= $rate ?>"><br><br>
    Time : <input type="number" name="time" step="0.01" required value="<?= $time ?>"><br><br>
    <input type="submit" value="Calculate">
</form>

<?php if ($simpleInterest !== null): ?>
    <h3>Simple Interest: <?= number_format($simpleInterest, 2) ?></h3>
    <h3>Compound Interest: <?= number_format($compoundInterest, 2) ?></h3>
<?php endif; ?>
</body>
</html>