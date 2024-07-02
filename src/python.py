import pdftables_api

# Initialize the API client with your API key
client = pdftables_api.Client('your-api-key')

# Specify the path to your PDF file and the output CSV file
pdf_path = 'CS_1B_E1_FINAL.pdf'
csv_path = 'cs1be1final.csv'

# Call the csv() method to convert the PDF to CSV
client.csv(pdf_path, csv_path)

#how to read file which was child of parent folder?