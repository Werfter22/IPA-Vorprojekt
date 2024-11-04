import pandas as pd
import psycopg2
from psycopg2 import sql

# Define database connection parameters
db_params = {
    'dbname': 'neue_komprimierte_liste_fuer_filemaker',
    'user': 'root',
    'password': 'Findus-7',
    'host': 'localhost',  # Usually 'localhost'
    'port': '5432'   # Usually 5432 for PostgreSQL
}

def insert_data_from_excel(file_path):
    # Establish a database connection
    conn = psycopg2.connect(**db_params)
    cursor = conn.cursor()

    # Read the Excel file
    df = pd.read_excel(file_path)

    # Prepare the SQL INSERT statement
    insert_query = sql.SQL('''
        INSERT INTO your_inventory_table_name (
            Barcode, Details, Name, QR_Code, Transport_Unit, Location
        ) VALUES (%s, %s, %s, %s, %s, %s)
    ''')

    # Iterate over each row in the DataFrame
    for index, row in df.iterrows():
        # Extract values for each column
        values = (
            row['Barcode'], row['Details'], row['Name'], 
            row['QR_Code'], row['Transport_Unit'], row['Location']
        )

        # Execute the insert command
        cursor.execute(insert_query, values)

    # Commit the changes and close the connection
    conn.commit()
    cursor.close()
    conn.close()

if __name__ == "__main__":
    # Specify the path to your Excel file
    excel_file_path = 'read_Scripts/PostgreSQL Liste - Neue_Komprimierte_Liste_für_FileMaker/Inventar Liste Original.xlsx'
    insert_data_from_excel(excel_file_path)
