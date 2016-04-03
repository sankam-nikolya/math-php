<?php
namespace Math\Statistics;

class Average {

  /**
   * Calculate the mean average of a list of numbers
   *
   * @param array $numbers
   * @return number
   */
  public static function mean( array $numbers ) {
    if ( empty($numbers) ) {
      return null;
    }
    return array_sum($numbers) / count($numbers);
  }

  /**
   * Calculate the median average of a list of numbers
   *
   * @param array $numbers
   * @return number
   */
  public static function median( array $numbers ) {
    if ( empty($numbers) ) {
      return null;
    }

    // Reset the array key indexes because we don't know what might be passed in
    $numbers = array_values($numbers);

    // For odd number of numbers, take the middle indexed number
    if ( count($numbers) % 2 == 1 ) {
      $middle_index = intdiv( count($numbers), 2 );
      return $numbers[$middle_index];
    }

    // For even number of items, take the mean of the middle two indexed numbers
    $left_middle_index  = intdiv( count($numbers), 2 ) - 1;
    $right_middle_index = $left_middle_index + 1;
    return self::mean( [ $numbers[$left_middle_index], $numbers[$right_middle_index] ] );
  }

  /**
   * Calculate the mode average of a list of numbers
   *
   * @param array $numbers
   * @return number
   */
  public static function mode( array $numbers ) {
    if ( empty($numbers) ) {
      return null;
    }

    // Count how many times each number occurs
    // Determine the max any number occurs
    // Find all numbers that occur max times
    $number_counts = array_count_values($numbers);
    $max           = max($number_counts);
    $modes         = array();
    foreach ( $number_counts as $number => $count ) {
      if ( $count === $max ) {
        $modes[] = $number;
      }
    }

    // Find the mean of all numbers that occur max times = mode
    return self::mean($modes);
  }
}