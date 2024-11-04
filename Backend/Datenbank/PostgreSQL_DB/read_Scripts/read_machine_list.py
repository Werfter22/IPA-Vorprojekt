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
        INSERT INTO your_table_name (
            IS_obsolete, Name, Function, Description, IS_Virtual, VM_Host, 
            CPU, Cores, RAM_MB, OS, OS_INFO, Location, 
            Lowest_Unit, Buy_Date, Value_Of_Hardware, Restore_Houres, 
            Serialnumber, Production_Date, Disposal_Date
        ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
    ''')

    # Iterate over each row in the DataFrame
    for index, row in df.iterrows():
        # Extract values for each column
        values = (
            row['IS_obsolete'], row['Name'], row['Function'], 
            row['Description'], row['IS_Virtual'], row['VM_Host'], 
            row['CPU'], row['Cores'], row['RAM_MB'], 
            row['OS'], row['OS_INFO'], row['Location'], 
            row['Lowest_Unit'], row['Buy_Date'], row['Value_Of_Hardware'], 
            row['Restore_Houres'], row['Serialnumber'], 
            row['Production_Date'], row['Disposal_Date']
        )

        # Execute the insert command
        cursor.execute(insert_query, values)

    # Commit the changes and close the connection
    conn.commit()
    cursor.close()
    conn.close()

if __name__ == "__main__":
    # Specify the path to your Excel file
    excel_file_path = 'read_Scripts/PostgreSQL Liste - Neue_Komprimierte_Liste_für_FileMaker/Machinen Liste.xlsx'
    insert_data_from_excel(excel_file_path)
