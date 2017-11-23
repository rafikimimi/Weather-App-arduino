using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO.Ports;
using MySql.Data.MySqlClient;
using System.Threading;

namespace Meteolology
{
    public partial class Form1 : Form
    {
        private SerialPort port = new SerialPort("COM13", 9600, Parity.None, 8, StopBits.One);
        private Boolean startandstop=false;
        string connetionString = null;
        MySqlConnection cnn;
       
           

        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
           
            if (startandstop==false)
            {
                startandstop = true;
                button1.Text = "Stop Capture";
                button1.ForeColor = Color.Green;
                this.Refresh();
                try
                {
                   
                    readandsavedata();
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Can not open connection ! ");
                }
            }
            else
            {
                startandstop = false;
                button1.Text = "Start Capture";
                button1.ForeColor = Color.Red;
              



            }



        }

        private void port_DataReceived(object sender, SerialDataReceivedEventArgs e)
        {
            
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            try
            {
                port.Open();
                button1.ForeColor = Color.Red;
            }
            catch(Exception)
            {
                MessageBox.Show("Connect Sensing System");
                Application.Exit();
            }
            
        }

        private void readandsavedata()
        {
            while(startandstop)
            {
                port.DataReceived += new SerialDataReceivedEventHandler(port_DataReceived);

                string data = port.ReadExisting().Trim();
                if (data != "")
                {
                    var sent = data.Split(' ').Distinct(StringComparer.CurrentCultureIgnoreCase);
                    string[] data1 = sent.ToArray();
                    label1.Text = "METEOROLOGICAL DATA";
                    Thread.Sleep(2000);
                    Double temperature = Convert.ToDouble(data1[0].Substring(0, 5));
                    Double RHumidity = Convert.ToDouble(data1[0].ToString().Substring(5, 5));
                    String Station = "DODOMA";
                    String ID = System.DateTime.Now.ToString() + Station;
                    DateTime date = System.DateTime.Now;

                    try
                    {
                        connetionString = "server=localhost;database=ammsdb;uid=root;pwd='';";
                        cnn = new MySqlConnection(connetionString);
                        cnn.Open();
                        MySqlCommand command = cnn.CreateCommand();
                        command.CommandText = "INSERT INTO meteolologydata (MeteorologyId,temperature,humidity,stationname) VALUES ('"+ ID +"','"+ temperature +"','"+ RHumidity+"','"+Station+"')";
                        command.ExecuteNonQuery();
                        cnn.Close();
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show(ex.Message);
                    }




                }

            }
           


        }
    }
}
