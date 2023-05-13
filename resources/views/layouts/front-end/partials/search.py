import sys
import cv2
import os
from skimage.metrics import structural_similarity as ssim

# Define the directory path where the images are stored
# Define the directory path where the images are stored
image_dir = r'C:/xampp/htdocs/ecommerce-den/public/storage/product'


# Load the input image
input_img_path = sys.argv[1]
if os.path.isfile(input_img_path):
    input_img = cv2.imread(input_img_path)
else:
    print("Input file not found.")
    exit()

# Resize the input image to a fixed size
input_img = cv2.resize(input_img, (256, 256))

# Convert the input image to grayscale
input_gray = cv2.cvtColor(input_img, cv2.COLOR_BGR2GRAY)

# Initialize a variable to store the filename of the matching image
match = None

# Loop through all images in the directory
for filename in os.listdir(image_dir):
    img_path = os.path.join(image_dir, filename)
    # Load the image from the directory
    img = cv2.imread(img_path)

    # Check if the image was loaded successfully
    if img is None:
        print(f"Unable to load image: {filename}")
        continue

    # Resize the directory image to a fixed size
    img = cv2.resize(img, (256, 256))

    # Convert the directory image to grayscale
    img_gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # Apply Gaussian blur to reduce noise and improve matching accuracy
    input_gray_blur = cv2.GaussianBlur(input_gray, (5, 5), 0)
    img_gray_blur = cv2.GaussianBlur(img_gray, (5, 5), 0)

    # Compute the structural similarity index (SSIM) between the input image and the directory image
    ssim_score = ssim(input_gray_blur, img_gray_blur, full=True)[0]

    # If the SSIM score is above a certain threshold, consider the images as a match
    threshold = 0.8
    if ssim_score > threshold:
        match = filename
        break

# If no matching image was found, print a message
if match is None:
    print("No match found.")
else:
    # Print the filename of the matching image
    print(match)
