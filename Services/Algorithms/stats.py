import os
import sys

from fpdf import FPDF
import pandas as pd

import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt



def analyze_column(column, col_name):
    analysis = {'name': col_name, 'dtype': column.dtype}
    if column.dtype == 'object':  # Object column
        try:
            avg_length = column.dropna().str.len().mean()
            analysis['type'] = 'string'
            analysis['unique_count'] = column.nunique()
            analysis['average_length'] = avg_length
            analysis['null_count'] = column.isnull().sum()
        except Exception:
            analysis['type'] = 'undefined'
    elif pd.api.types.is_numeric_dtype(column):  # Numeric column
        analysis['type'] = 'numeric'
        analysis['mean'] = column.mean()
        analysis['median'] = column.median()
        analysis['mode'] = column.mode().iloc[0] if not column.mode().empty else None
        analysis['std_dev'] = column.std()
        analysis['null_count'] = column.isnull().sum()
    else:
        analysis['type'] = 'undefined'
    return analysis


def create_distribution_chart(column, col_name, output_dir):
    plt.figure(figsize=(8, 6))
    column.dropna().plot(kind='hist', bins=30, alpha=0.7, color='blue', edgecolor='black')
    plt.title(f"Distribution of {col_name}")
    plt.xlabel(col_name)
    plt.ylabel("Frequency")
    plt.grid(True)
    chart_path = os.path.join(output_dir, f"{col_name}_distribution.png")
    plt.savefig(chart_path)
    plt.close()
    return chart_path


def create_pdf(data, output_pdf):
    pdf = FPDF()
    pdf.set_auto_page_break(auto=True, margin=15)
    pdf.set_font("Arial", size=12)

    temp_dir = "temp_charts"
    os.makedirs(temp_dir, exist_ok=True)

    for col_name in data.columns:
        column = data[col_name]
        analysis = analyze_column(column, col_name)

        pdf.add_page()
        pdf.set_font("Arial", size=14)
        pdf.cell(0, 10, f"Column: {col_name}", ln=True)
        pdf.set_font("Arial", size=12)
        pdf.cell(0, 10, f"Data Type: {analysis['dtype'] if analysis['type'] != 'string' else 'string'}", ln=True)

        if analysis['type'] == 'string':
            pdf.cell(0, 10, f"Unique Values: {analysis['unique_count']}", ln=True)
            pdf.cell(0, 10, f"Average Length: {analysis['average_length']:.2f}", ln=True)
            pdf.cell(0, 10, f"Null Count: {analysis['null_count']}", ln=True)
        elif analysis['type'] == 'numeric':
            pdf.cell(0, 10, f"Mean: {analysis['mean']:.2f}", ln=True)
            pdf.cell(0, 10, f"Median: {analysis['median']:.2f}", ln=True)
            pdf.cell(0, 10, f"Mode: {analysis['mode']}", ln=True)
            pdf.cell(0, 10, f"Standard Deviation: {analysis['std_dev']:.2f}", ln=True)
            pdf.cell(0, 10, f"Null Count: {analysis['null_count']}", ln=True)
            chart_path = create_distribution_chart(column, col_name, temp_dir)
            pdf.image(chart_path, x=10, y=pdf.get_y() + 5, w=180)
        elif analysis['type'] == 'undefined':
            pdf.cell(0, 10, "This column contains unsupported or mixed data types.", ln=True)

    pdf.output(output_pdf)

    for file in os.listdir(temp_dir):
        os.remove(os.path.join(temp_dir, file))
    os.rmdir(temp_dir)


if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python csv_to_pdf.py <csv_file_path> <csv_file_name>")
        sys.exit(1)

    csv_file = sys.argv[1]
    output_pdf = f"/tmp/{sys.argv[2]}_stats.pdf"

    try:
        data = pd.read_csv(csv_file)
        create_pdf(data, output_pdf)
        print("SUCCESS" , end='')
    except Exception as e:
        print(e)
