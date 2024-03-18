<?php
include_once "../settings/connection.php";
include_once "../settings/core.php";

// Initialize arrays to store labels and data
$labels = [];
$data = [];

// Get the current date
$currentDate = date("Y-m-d");

// Weekly data
$startDate = date("Y-m-d", strtotime('monday this week', strtotime($currentDate)));
$endDate = date("Y-m-d", strtotime('sunday this week', strtotime($currentDate)));
$weekData = fetchTransactionData($startDate, $endDate, 'week');
// Splice the first 2 elements of the $weekData array
$weekData = array_slice($weekData, 2);
$labels['week'] = getWeekLabels($startDate, $endDate);
$data['week'] = $weekData;


// Monthly data
$firstDayOfMonth = date("Y-m-01", strtotime($currentDate));
$lastDayOfMonth = date("Y-m-t", strtotime($currentDate));
$monthData = fetchTransactionData($firstDayOfMonth, $lastDayOfMonth, 'month');
$labels['month'] = getMonthLabels($firstDayOfMonth, $lastDayOfMonth);
$data['month'] = $monthData;

// Yearly data
$firstDayOfYear = date("Y-01-01", strtotime($currentDate));
$lastDayOfYear = date("Y-12-31", strtotime($currentDate));
$yearData = fetchTransactionData($firstDayOfYear, $lastDayOfYear, 'year');
$labels['year'] = getYearLabels($firstDayOfYear, $lastDayOfYear);
$data['year'] = $yearData;

// Convert arrays to JSON format for JavaScript consumption
$chartData = json_encode([
    'labels' => $labels,
    'data' => $data
]);

// Close connection
$con->close();

// Return chart data
echo $chartData;

// Function to fetch transaction data for a specific date range and time period
function fetchTransactionData($startDate, $endDate, $period) {
    global $con;
    $sql = "";
    if ($period === 'week') {
        // SQL query for weekly data
        $sql = "SELECT DAYNAME(TransactionDate) AS DayOfWeek, SUM(Amount) AS TotalAmount 
                FROM Transaction
                WHERE UserID = ? 
                AND TransactionDate BETWEEN ? AND ?
                GROUP BY DAYNAME(TransactionDate)";
    } elseif ($period === 'month') {
        // SQL query for monthly data
        $sql = "SELECT DAY(TransactionDate) AS DayOfMonth, SUM(Amount) AS TotalAmount 
                FROM Transaction
                WHERE UserID = ? 
                AND TransactionDate BETWEEN ? AND ?
                GROUP BY DAY(TransactionDate)";
    } elseif ($period === 'year') {
        // SQL query for yearly data
        $sql = "SELECT MONTH(TransactionDate) AS MonthOfYear, SUM(Amount) AS TotalAmount 
                FROM Transaction
                WHERE UserID = ? 
                AND TransactionDate BETWEEN ? AND ?
                GROUP BY MONTH(TransactionDate)";
    }
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iss", $userID, $startDate, $endDate);
    $userID = $_SESSION['user_id'] /* Set the user ID here */;
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an associative array to store transaction data
    $data = [];

    while ($row = $result->fetch_assoc()) {
        if ($period === 'week') {
            $data[$row['DayOfWeek']] = $row['TotalAmount'];
        } elseif ($period === 'month') {
            $data[$row['DayOfMonth']] = $row['TotalAmount'];
        } elseif ($period === 'year') {
            $data[$row['MonthOfYear']] = $row['TotalAmount'];
        }
    }

    // Close statement
    $stmt->close();

    // Fill in missing data points with 0
    if ($period === 'week') {
        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        foreach ($daysOfWeek as $day) {
            if (!isset($data[$day])) {
                $data[$day] = 0;
            }
        }
    } elseif ($period === 'month') {
        for ($day = 1; $day <= 31; $day++) {
            if (!isset($data[$day])) {
                $data[$day] = 0;
            }
        }
    } elseif ($period === 'year') {
        for ($month = 1; $month <= 12; $month++) {
            if (!isset($data[$month])) {
                $data[$month] = 0;
            }
        }
    }

    // Sort data by keys
    ksort($data);

    // Convert associative array to sequential array
    $data = array_values($data);

    return $data;
}

// Function to generate week labels
function getWeekLabels($startDate, $endDate) {
    $labels = [];
    $currentDate = $startDate;
    while (strtotime($currentDate) <= strtotime($endDate)) {
        $labels[] = date("D", strtotime($currentDate));
        $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
    }
    return $labels;
}

// Function to generate month labels
function getMonthLabels($firstDayOfMonth, $lastDayOfMonth) {
    $labels = [];
    $currentDate = $firstDayOfMonth;
    while (strtotime($currentDate) <= strtotime($lastDayOfMonth)) {
        $labels[] = date("D", strtotime($currentDate));
        $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
    }
    return $labels;
}

// Function to generate year labels
function getYearLabels($firstDayOfYear, $lastDayOfYear) {
    $labels = [];
    $currentDate = $firstDayOfYear;
    while (strtotime($currentDate) <= strtotime($lastDayOfYear)) {
        $labels[] = date("M", strtotime($currentDate));
        $currentDate = date("Y-m-d", strtotime($currentDate . "+1 month"));
    }
    return $labels;
}
?>
