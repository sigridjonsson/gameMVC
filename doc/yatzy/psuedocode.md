Sub fizzbuzz()
  For i = 1 to 100
    print_number = True
    If i is divisible by 3 Then
      Print "Fizz"
      print_number = False
    End If
    If i is divisible by 5 Then
      Print "Buzz"
      print_number = False
    End If
    If print_number = True Then print i
    Print a newline
  Next i
End Sub


----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------




Roll five dices
When dices are rolled the variable rolls should increase by 1
Give user a chance to save some dices

If user saves some dices and rolls does not equal 3
    Remove them from list of all dices and roll remaining dices

Else if user does not save some dices and rolls does not equal 3
    Roll all dices

Else
    Display result
