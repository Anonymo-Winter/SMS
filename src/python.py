import tabula
df = tabula.read_pdf("CSE-1A_E1.pdf", pages='all')[0]
tabula.convert_into("CSE-1A_E1.pdf", "CSE-1A.csv", output_format="csv", pages='all')