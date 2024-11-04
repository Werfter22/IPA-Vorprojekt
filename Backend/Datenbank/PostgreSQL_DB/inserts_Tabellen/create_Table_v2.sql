-- Tabelle für die Inventar Liste Original
CREATE TABLE Inventar_Liste_Original (
    Inventar_Liste_Original_ID SERIAL PRIMARY KEY,
    Barcode VARCHAR(250),
    QR_Code VARCHAR(250),
    Name VARCHAR(250),
    Details TEXT,
    Transport_Unit VARCHAR(250),
    Location VARCHAR(250)
);

-- Tabelle für die Maschinen Liste
CREATE TABLE Machine_List (
    Machine_Liste_ID SERIAL PRIMARY KEY,
    IS_Obsolete BOOLEAN,
    Machine_Name VARCHAR(250), -- aktualisiert von 'Name' zu 'Machine_Name'
    Machine_Function VARCHAR(250), -- aktualisiert von 'Function' zu 'Machine_Function'
    Machine_Description TEXT, -- aktualisiert von 'Description' zu 'Machine_Description'
    IS_Virtual BOOLEAN,
    VM_Host VARCHAR(250),
    CPU VARCHAR(250),
    Cores VARCHAR(250),
    Ram_MB VARCHAR(250),
    OS VARCHAR(250),
    OS_INFO VARCHAR(250),
    Machine_Location VARCHAR(250), -- aktualisiert von 'Location' zu 'Machine_Location'
    Lowest_Unit FLOAT,
    Buy_Date TIMESTAMP,
    Value_Of_Hardware FLOAT,
    Restore_hours INTERVAL,
    Serialnumber VARCHAR(250),
    Production_Date TIMESTAMP,
    Disposal_Date TIMESTAMP
);

-- Tabelle für die Benutzer
CREATE TABLE Users (  -- aktualisiert von 'User' zu 'Users'
    User_ID SERIAL PRIMARY KEY,
    Lastname VARCHAR(250),
    Firstname VARCHAR(250),
    Email_1 VARCHAR(250),
    Email_2 VARCHAR(250),
    Email_3 VARCHAR(250)
);

-- Tabelle für die Geräte
CREATE TABLE Devices (
    Device_ID SERIAL PRIMARY KEY,
    Device_Name_1 VARCHAR(250),
    Device_Name_2 VARCHAR(250),
    Device_Name_3 VARCHAR(250),
    Device_Name_4 VARCHAR(250),
    Device_Name_5 VARCHAR(250),
    Device_Name_6 VARCHAR(250),
    Device_Name_7 VARCHAR(250),
    Device_Name_8 VARCHAR(250),
    Device_Name_9 VARCHAR(250),
    Device_Name_10 VARCHAR(250),
    Device_Name_11 VARCHAR(250),
    Device_Name_12 VARCHAR(250),
    Serialnumber_1 VARCHAR(250),
    Serialnumber_2 VARCHAR(250),
    Serialnumber_3 VARCHAR(250),
    Serialnumber_4 VARCHAR(250),
    Serialnumber_5 VARCHAR(250),
    Serialnumber_6 VARCHAR(250),
    Serialnumber_7 VARCHAR(250),
    Serialnumber_8 VARCHAR(250),
    Serialnumber_9 VARCHAR(250),
    Serialnumber_10 VARCHAR(250),
    Serialnumber_11 VARCHAR(250),
    Serialnumber_12 VARCHAR(250),
    OS_1 VARCHAR(250),
    OS_2 VARCHAR(250),
    OS_3 VARCHAR(250),
    OS_4 VARCHAR(250),
    OS_5 VARCHAR(250),
    OS_6 VARCHAR(250),
    OS_7 VARCHAR(250),
    OS_8 VARCHAR(250),
    OS_9 VARCHAR(250),
    OS_10 VARCHAR(250),
    OS_11 VARCHAR(250),
    OS_12 VARCHAR(250),
    QR_Code VARCHAR(250),
    Barcode VARCHAR(250),
    IS_Werft_Device BOOLEAN,
    IS_Home_Office_Device BOOLEAN
);

-- Tabelle für die Telefone
CREATE TABLE Phones (
    Phone_ID SERIAL PRIMARY KEY,
    Mobile_Number_1 VARCHAR(250),
    Mobile_Number_2 VARCHAR(250),
    Mobile_Number_3 VARCHAR(250),
    Mobile_Number_4 VARCHAR(250),
    Mobile_Number_5 VARCHAR(250),
    Mobile_Number_6 VARCHAR(250),
    Mobile_Number_7 VARCHAR(250),
    Mobile_Number_8 VARCHAR(250),
    Mobile_Number_9 VARCHAR(250),
    Mobile_Number_10 VARCHAR(250),
    Mobile_Number_11 VARCHAR(250),
    Mobile_Number_12 VARCHAR(250),
    Work_Number_1 VARCHAR(250),
    Work_Number_2 VARCHAR(250),
    Work_Number_3 VARCHAR(250),
    Work_Number_4 VARCHAR(250),
    Work_Number_5 VARCHAR(250),
    Work_Number_6 VARCHAR(250),
    Work_Number_7 VARCHAR(250),
    Work_Number_8 VARCHAR(250),
    Work_Number_9 VARCHAR(250),
    Work_Number_10 VARCHAR(250),
    Work_Number_11 VARCHAR(250),
    Work_Number_12 VARCHAR(250),
    QR_Code VARCHAR(250),
    Barcode VARCHAR(250)
);



-- Zwischentabelle: User_Device
CREATE TABLE User_Device (
    user_id INT REFERENCES Users(User_ID) ON DELETE CASCADE,
    device_id INT REFERENCES Devices(Device_ID) ON DELETE CASCADE,
    zugeordnet_seit TIMESTAMP,
    nutzungsstatus VARCHAR(250),
    PRIMARY KEY (user_id, device_id)
);


-- Zwischentabelle: User_Phone
CREATE TABLE User_Phone (
    user_id INT REFERENCES Users(User_ID) ON DELETE CASCADE,
    phone_id INT REFERENCES Phones(Phone_ID) ON DELETE CASCADE,
    nutzungsstatus VARCHAR(250),
    besitzdauer INTERVAL,
    PRIMARY KEY (user_id, phone_id)
);


-- Zwischentabelle: Inventar_Device
CREATE TABLE Inventar_Device (
    inventar_id INT REFERENCES Inventar_Liste_Original(Inventar_Liste_Original_ID) ON DELETE CASCADE,
    device_id INT REFERENCES Devices(Device_ID) ON DELETE CASCADE,
    zugewiesen_am TIMESTAMP,
    zustand VARCHAR(250),
    PRIMARY KEY (inventar_id, device_id)
);


-- Zwischentabelle: Machinen_Device
CREATE TABLE Machinen_Device (
    maschine_id INT REFERENCES Machine_List(Machine_Liste_ID) ON DELETE CASCADE,
    device_id INT REFERENCES Devices(Device_ID) ON DELETE CASCADE,
    verwendungszweck VARCHAR(250),
    nutzungszeitraum INTERVAL,
    PRIMARY KEY (maschine_id, device_id)
);
