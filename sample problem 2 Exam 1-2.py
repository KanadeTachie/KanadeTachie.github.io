def has_duplicates(arr):
    seen = set()  # Set to store the elements seen so far
    
    for num in arr:
        if num in seen:
            return True
        seen.add(num)
    
    return False

# Example usage
array = [5, 8, 2, 9, 3, 6, 2, 7]
print(has_duplicates(array))